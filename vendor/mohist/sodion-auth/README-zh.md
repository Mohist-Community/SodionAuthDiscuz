# SodionAuth for PHP
快速实现SodionAuth Api

# 实现方式
创建一个class extends Mohist\SodionAuth\Provider\UserProvider并实现UserProvider内的方法

创建一个控制器并创建到控制器的路由

在控制器中调用Mohist\SodionAuth\Provider\UserProvider

参见 https://github.com/Mohist-Community/SodionAuthFlarum

