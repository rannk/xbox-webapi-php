# Xbox-WebAPI-PHP

Xbox-WebAPI-PHP 是一款采用PHP语言，通过您的微软账户/Xbox账户验证，获取用户XBox Live相关信息。

用户的验证方式是采用微软的OAuth2验证方式

使用此库前，需要先登录Azure AD创建一个应用, 如果你已经有一个应用也可以使用.

- Register a new application in [Azure AD](https://portal.azure.com/#blade/Microsoft_AAD_RegisteredApps/ApplicationsListBlade)
  - Name your app
  - Select "Personal Microsoft accounts only" under supported account types
  - Add <http://localhost/auth/callback> as a Redirect URI of type "Web"
- Copy your Application (client) ID for later use
- On the App Page, navigate to "Certificates & secrets"
  - Generate a new client secret and save for later use
  
## Dependencies

- PHP > 7.3

## How to use

通过composer工具把此库添加到自己项目中
composer require rannk/xbox-webapi-php

也可以直接下载本仓库文件，参考example中的一些执行例子。

example/oauthLogin.php 浏览器访问这个文件会跳转到微软的登录页面，并要求您登录授权。
example/callback.php 如果你在之前Azure AD创建的应用中设置好的回调地址是这个文件，那么在前面你登录授权后会调整到这个页面，并打印相关的用户信息。
example/xboxUser.php 把前面callback.php中打印的相关信息配置到此文件中，您可以获取到您在Xbox的基本信息，成就，好友信息等 






