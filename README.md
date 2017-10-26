# Nette-ShibbolethAuthExtension
Simple authentication using Shibboleth


For usage, include into your config.neon:
```
    ShibbolethAuthenticator: Vojir\ShibbolethAuthExtension\DI\ShibbolethAuthExtension
```

and into .htaccess append:
```apacheconfig
AuthType shibboleth
Require shibboleth

RewriteRule ^Shibboleth\.sso.*$ - [L,NC]
```