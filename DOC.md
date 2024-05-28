DOC.md

# 跳转与统计 
	https://statistics.savefamily.net/redirect?target=
	http://127.0.0.1:8000/redirect?target=https://*.com/@fwdforward/7XFVL5o.m4a?metric=connect%26category=601%26bot=4
    // metric:默认是connect 收听/看/点击链接
    // by：author 可选 %26author=@fwdforward
    // http://127.0.0.1:8000/redirect?target=https://navs.savefamily.net%3Fvips=10,15,11,16,17%26metric=NFC%26keyword=nav

# 9空格导航之卢牧师每日读经
	https://statistics.savefamily.net/go/pastorlu

# auth.check-in-out.online 
	php artisan install:api --passport
	https://www.youtube.com/watch?v=PTFPMAX_88s

	GET http://x-laravel.test/oauth/authorize?client_id=9c2796cd-efff-4e84-b64a-c600a9b93f8a&redirect_uri=http://passport.test/auth/callback&response_type=code&scope&state=9yF7OoMp5iFL4TPpyQTxpf9WBKaMUbnCkKf0mDGe
	==>
		http://passport.test/auth/callback?code=def502008465b5944a767fa8b821393e59dbc62d43b73224cf2251f7c9836f3104b190861a6d4540d4bb594bf4782dcd22dfe7dd09ff5f695b00a30c1872caf0350a73feec526604fe02bc29bc4aaddc11944b94014456aaeff1e9bf3a59f471761c8af958b4a8f19a1993f18bfd351e1ddb17ff551b565fd4f8f423abe08fad6fbe4fc98ba9f17aa088ee86b61e36226c66de4bac2f408cd42d32464a31c850ddc0d35c9ee36bde709600dd27ce3bd40699bb04994f9346795976d64cbd60383d5d1a5bd2493820c44ba0736541c98e1302fdee0b0d59ce158d45f2bbe83309c96decac46daff0dc05c48f79bca409c26f24208736fd02f0fadb698d6187516d80dd4b4ca5cb1cc9ddf5b305e47122bc3e0af471afc17c1ed74432c2a2ca3f163b10f62fc4d3bd31775d03ae170b5a3f8c82660337e1d8889a14f9404ba40cea962b40850bf30d07414db47d6957a26b5fef518369a0d64dfc19ef5c6d5ca32655b89c93d24c307f791ac6ed34c605657ddfb240a61194d34eaf4ae3035d0b702508625ac90&state=9yF7OoMp5iFL4TPpyQTxpf9WBKaMUbnCkKf0mDGe

	==> POST http://x-laravel.test/oauth/token
		grant_type=authorization_code
		client_id=
		redirect_uri=
		client_secret=
		code=
		then get access_token and refresh_token
		
	==> POST http://passport.test/oauth/token
		grant_type=refresh_token
		refresh_token=
		client_id=
		redirect_uri=
		client_secret=
