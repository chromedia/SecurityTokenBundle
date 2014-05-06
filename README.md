Chromedia Security Token Bundle
===============================

### Installation
1. Install using Composer
2. Add bundle in AppKernel
3. Create configuration


### Configuration
```
	chromedia_security_token:
		#required
    	token_provider: service_id_for_your_token_provider
    	encryption: md5 | sha256

    	# optional
    	authorization_header_key: key_to_be_used_in_headers
    	access_key_request_parameter: access_key_request_parameter_name
    	access_token_request_parameter: access_token_request_parameter_name

```

### Usage
1. Create token provider class and implement `Chromedia\SecurityTokenBundle\Provider\AccessTokenProviderInterface` and define this as a service.
```
	class AccessTokenProvider implements AccessTokenProviderInterface
	{
		public function loadToken($token, $key=null)
		{
			// load and verify token from database
		}

		public function generateToken($salt=null)
		{
			// generate token string using your preferred algorithm
		}
	}
```

2. Let your selected controller implement `Chromedia\SecurityTokenBundle\Controller\TokenAuthenticatedController` 
```
	class AuthenticatedApiController implements TokenAuthenticatedController
	{
    	public function indexAction()
    	{
    		// blah blah blah
    	}
	}
```

