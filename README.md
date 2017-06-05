Yii 2 yii2-ecomerce-sample
===============================
###### โปรเจ็คนี้จัดทำขึ้นเพื่อเป็นตัวอย่างระบบอีคอมเมิร์ชอย่างง่าย สำหรับผู้เริ่มต้นศึกษา Yii Framework 2 ไม่แนะนำให้เอาไปใช้งานจริง

1. โคลนโปรเจ็คเข้าไปที่ document root เช่น c:\xampp\htdocs
```
cd c:\xampp\htdocs
git clone https://github.com/andatech/yii2-ecommerce-sample.git yii2-ecommerce-sample
```

2. ติดตั้ง packages
```
cd yii2-ecommerce-sample
composer install
php init ----->ตอบ 0
composer update
```

3. ปรับแต่งค่า (Config)
```
//common/config/main-local.php
<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=database_name',
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8',
        ],
        ...
    ],
];
```

3. ติดตั้ง Database โดยการ Import จากไฟล์ ecommerce_db.sql

4. รันโปรเจค
```
http://localhost/yii2-ecommerce-sample
```
ถ้าให้ดีควรทำ virtual host ศึกษาจากเว็บนี้ก็ได้
[http://share.olanlab.com/th/it/blog/view/142](http://share.olanlab.com/th/it/blog/view/142)

5. Username/Password
```
Admin สูงสุด
User: admin
Pass: 123456

พนักงานดูแลตะกร้าสินค้า
User: employee1
Pass: 123456

ลูกค้า
User: customer1
Pass: 111111

User: customer2
Pass: 111111
```

6. ลิงค์ (Routes)
```
/ = หน้าร้าน (Frontend)
/admin = หลังร้าน (Backend)
/admin/rbac = ระบบจัดการสิทธิ์ของผู้ใช้ (เซ็ตไว้ให้ใช้ได้เฉพาะ admin)
/user = ระบบจัดการข้อมูลส่วนตัวของผู้ใช้
