package com.royalpay.payment.web;

import com.alibaba.fastjson.JSONObject;
import com.royalpay.payment.support.exceptions.BadRequestException;
import com.royalpay.payment.support.exceptions.ServerErrorException;
import com.royalpay.payment.support.http.HttpRequestGenerator;
import com.royalpay.payment.support.http.HttpRequestResult;
import org.apache.commons.codec.digest.DigestUtils;
import org.apache.commons.lang.RandomStringUtils;
import org.apache.commons.lang.time.DateFormatUtils;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.io.IOException;
import java.net.URISyntaxException;
import java.util.Date;

/**
 * Created by davep on 2016-07-24.
 */
@Controller
@RequestMapping("/api/payment")
public class PayController {
    private static final String PARTNER_CODE = "PINE";
    private static final String CREDENTIAL_CODE = "kl0euLDBij1crzsdrVzTM5QiV6cvHkku";
    @Value("${app.host}")
    private String host;

    @RequestMapping(value = "/order", method = RequestMethod.GET)
    public String orderPage() {
        return "order";
    }

    @RequestMapping(value = "/new_order", method = RequestMethod.GET)
    public String wxOrderJump(@RequestHeader(name = "User-Agent") String userAgent, @RequestParam(defaultValue = "false") boolean qrcode,
                              @RequestParam(defaultValue = "false") boolean direct) throws URISyntaxException, IOException {
        String orderId = "TEST_" + DateFormatUtils.format(new Date(), "yyyyMMddHHmmss") + "_" + RandomStringUtils.random(5, true, true).toUpperCase();
        JSONObject param = new JSONObject();
        param.put("price", 10);
        param.put("description", "DemoTest");
        param.put("notify_url", host + "api/orders/" + orderId + "/callback");
        param.put("operator", "web");
        String createUrl;
        if (userAgent.toLowerCase().contains("micromessenger") && !qrcode) {
            //wechat
            createUrl = "https://mpay.royalpay.com.au/api/v1.0/wechat_jsapi_gateway/partners/" + PARTNER_CODE + "/orders/" + orderId + "?" + queryParams();
        } else {
            createUrl = "https://mpay.royalpay.com.au/api/v1.0/gateway/partners/" + PARTNER_CODE + "/orders/" + orderId + "?" + queryParams();
        }
        HttpRequestResult result = new HttpRequestGenerator(createUrl, RequestMethod.PUT).setJSONEntity(param).execute();
        if (result.isSuccess()) {
            JSONObject res = result.getResponseContentJSONObj();
            if ("SUCCESS".equals(res.getString("return_code"))) {
                String payUrl = res.getString("pay_url") + "?" + queryParams() + "&redirect=" + host + "api/payment/orders/" + orderId + "/success";
                if (direct) {
                    payUrl += "&directpay=true";
                }
                return "redirect:" + payUrl;
            }
        }
        throw new ServerErrorException("Failed to Request RoyalPay! Wait for a minute");
    }

    @RequestMapping(value = "/orders/{orderId}/success", method = RequestMethod.GET)
    public String payCallbackPage(@PathVariable String orderId, Model model) throws URISyntaxException, IOException {
        model.addAttribute("order_id", orderId);
        String url = "https://mpay.royalpay.com.au/api/v1.0/gateway/partners/" + PARTNER_CODE + "/orders/" + orderId + "?" + queryParams();
        HttpRequestResult result = new HttpRequestGenerator(url, RequestMethod.GET).execute();
        if (result.isSuccess()) {
            JSONObject res = result.getResponseContentJSONObj();
            model.addAttribute("order_info", res);
        }
        return "success";
    }

    private String queryParams() {
        long time = System.currentTimeMillis();
        String nonceStr = RandomStringUtils.random(15, true, true);
        String validStr = PARTNER_CODE + "&" + time + "&" + nonceStr + "&" + CREDENTIAL_CODE;
        String sign = DigestUtils.sha256Hex(validStr).toLowerCase();
        return "time=" + time + "&nonce_str=" + nonceStr + "&sign=" + sign;
    }
}
