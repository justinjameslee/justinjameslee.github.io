package com.royalpay.payment.support.websocket;

import com.alibaba.fastjson.JSON;
import org.apache.commons.io.IOUtils;
import org.springframework.web.socket.sockjs.frame.SockJsMessageCodec;

import java.io.IOException;
import java.io.InputStream;
import java.util.List;

/**
 * codec
 * Created by yixian on 2016-03-14.
 */
public class FastJsonSockJsMessageCodec implements SockJsMessageCodec {

    @Override
    public String encode(String... messages) {
        String jsonString = JSON.toJSONString(messages);
        return "a" + jsonString;
    }

    @Override
    public String[] decode(String content) throws IOException {
        List<String> strings = JSON.parseArray(content, String.class);
        return strings.toArray(new String[strings.size()]);
    }

    @Override
    public String[] decodeInputStream(InputStream content) throws IOException {
        List<String> strings = JSON.parseArray(IOUtils.toString(content), String.class);
        return strings.toArray(new String[strings.size()]);
    }
}
