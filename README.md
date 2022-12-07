# The best mail sending class of hyperf
examples:
```php
   app(\yjHyperfAdminPligin\Email\Email::class)
        ->setSubject('setSubject')
        ->setAddress("1324028467@qq.com")
        ->setBody('testbody')
        ->send();
```