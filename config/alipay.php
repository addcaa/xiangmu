<?php
return  array (
		//应用ID,您的APPID。
		'app_id' => "2016092500595135",

		//商户私钥
		'merchant_private_key' => "MIIEogIBAAKCAQEAq5ZVpj6lUR4wXLM2L+6klXl3SbnqwT6dUSILWJSTgwi9BnbNRgLvhaHS0rbZUPebGBuQBUeuya8SC2mwLo96gAxHfb/JJ2Ni8HJiZP8TjCI1iTtB3QE1JcXjr9mhC8/97TAs5Z3lshN4Oq11xXGVbpATUr75tf79In1UvnzamqhDMHIMv18yNJ0WPv8GiFlkoi2dAoJTkBfFzyHMyS6aTRcU9a0NqqfMHAHoKJi+nko5dHrbUMM4aPmWd746snB1xS9t2XCOrI/YOvobeTUchSEsuBRoHr+vR3XhmEewdVs+nlEd1/Kg5gPFw4ta5FF+2134PYxZngxKof8E1woWAQIDAQABAoIBAB/AJsMnbnHPM0XEB6/g6eWa317uHyl5C6U6tnzCqXUixc+PZjahTm8c3aUOHrJjzvgsCX9gn1BErAMeoHJNLG7LVuNG/NLkCifSErD7nkNdBSkKpQpfMdV2g8ZDcBB+gU9FjdlDWYCVJ7c758IMXYli8aBrJEvwDik2pdrFwbHCSW7rV47soge6TBxo0nw0aBbJx36ZgHJqXU46AbUxNHa0NK2/9m8BRx4DaSPti98+GNddXBeI4v56RVNAbbUHSC/FF8d+mzKB6Fe1/bHWPL/nJuVw1fzKHkWLTs5DliJWeXeUrsyL5qrn/u2Qpohps14ITEjHYKRh2dqkVXtkuT0CgYEA1lS01X2odBr+uoodCfan3dk6j45uXAs4EMJQGBRkhmHHyCUK/6z0ZjL+pXWmtC9UZQeiEzdOI8cTKjCDM7RtnKrXYs0MUxMSgs2fAMtdaGs6IYZjoYYQooJ8aveeu0hsJp5OkmRZ2KlCzB7313CfK7fLSKEFW91Fx0FBmgcLnpcCgYEAzPJEpaKFF89DNYD5kY/2+NEO9DKt9ncdOjhXWqsPPb1nFTZeio+z/JDIgiX1fGOlYMvhIavKsPb9E/xLqa0+q0WtOzAPJS2t04u/QyEarEQ1eKha5D4euFY9nrQH1qGNrPNR2MBRC9ByJ3tWGkfuSBU/FYHky3lp21UgH+YtGycCgYAYg8fLQ3wpC41nOLTpltTMgzQ3h0sILCBVimQu3OZCmJyJP/NqGxY5Okv2EOboZSF6DM109TZy0SpYAQSAvXpsGP5ZxqpKNjw/ydUN+jTM5LbZbs2mg/cTH2mrsnbtZPM515GVHPVJ2tJRFpmygqcyEOunewNp5n08tTITtAqYMQKBgHKUgAyacA5/sfOXx++5rToup02fh+LjdVO3bB8kw8Cgw6D4ZKLS9K2fxHn+/uAsValoUtWgVhHaBGPICgUy9naK3e7ZT55Zi3VaC/Rb7a2h9MMgXLB+im5EyO6ReFBmwe6PmpKz8pvITgoEyn6m+HEUb9B2bpPTrXsSfINZDJ7BAoGAWiYfe9WOcc0lDlxd3wMFJLRvT3Dr+6qKtJ3ZD4xEEq1n3cqKdnM6TqJ+eiq1DJ2WEoBru5YrdqliqwqzuMCxlDyVbstQpY7bUQbDkwSvU+Bh+z76F1tYCpMV6XXxh5iZEAZrcFgtVtSSeH4C4iulOlZu4ak/NEBp38WEbj6ceQo=",

		//异步通知地址
		'notify_url' => "http://localhost/zf/notify_url.php",

		//同步跳转
		'return_url' => "http://www.laravel.com/goods/alipay",
		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjueCir1ay5F5Zs9Yw3YA/pmQrEO1803u2ZItVCstCxNXuVTOyMC19+JDsFuCgpshteChVF+qp3aAT1rznYO7ujcMRHqZjjiSNzHIFIjg1X6Q2U5CGY+cklSyBewiF+cyEkBg62TSlGEgHhdXMtpa6kxujgy7L6SN8VEVPN8/fIwRS24RFeJv7xndCStrtcrocG+H6CJnzxBwkH8ICpopZTgCCTxraKKv6xA7maRS6YiS46/+t/X66pdgohaz9z7RhrfD4oTi2aRIz9L0FRnKx+7SU0lFJfYk1X4jBKCDMXcneVt+vFw10NguQORMmMb9UWhVnQs9mV/yw/De91QlAwIDAQAB",
);
