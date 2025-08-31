# Laravel / PHP Savol Jovob 

## Laravel/PHP

**Savol:**

 • Katta loyihalarda kodni tartibli saqlash uchun qanday usullardan foydalanasiz?

 • Siz ko‘proq Eloquent ORM ishlatasizmi yoki to‘g‘ridan-to‘g‘ri SQL yozasizmi? Qachon qaysi birini tanlaysiz?

 • Middleware’ni qaysi holatlarda ishlatib ko‘rgansiz?

**Jovob:** 

 • Service & Repository Pattern va Modulniy arxitektura ishlataman va class nomlarini togri nomlash orqali tartibini saqlayman lekin agar loyha uta kotta boladigan bolsa va Traffic yuqori bolsa Microservice bolgan yaxshiroq Monolit yo Modular orniga Microservice da Message Brokerlar dan RabbitMQ va Kafka bor asosan man Kafka ishlatkan bolardim sababi Kafka RMQ dan kora Tezroq ishlaydi va Open Source 

 • Eloquent Ishlataman va toza RAW SQL yozishtan ehtiyot bolaman sababi toza RAW SQL SQL Injection hujumi uchun juda qulay lazeyka disa ham boladi 

 • Middlewareni RBAC ( Rollback Access Control ) bilan ishlataman va userlardi rollarga bolish uchun


## API

**Savol:**

 • API’laringizni qanday qilib versiyalaysiz?

 • API xavfsizligi uchun qanday choralarni ko‘rasiz?

 • Ma’lumot ko‘p bo‘lsa, pagination yoki filteringni qanday qilasiz?

**Jovob:** 

 • URL Orqali ( Route Group ) structuraga controller request resource lar pod papka orqali v1/controller/Request/Resource qilib qollasa boladi lekin proyyekt fayilari kopayib loyha yanada ogirlashadi va ishlashta sekinlashadi 

 • Token Authentication ( Passport, JWT JSON Web Token ) va user dan kop request kelsa Rate limiting va kiritilib turgan malumotlarni Validattsya va CORS, HTTPS ishlataman

 •  Laravel Resource + paginate() yoki cursorPaginate() bilan query scope ishlataman 

## Ma’lumotlar bazasi (PostgreSQL)

**Savol:**

• Nega PostgreSQL tanlaysiz, masalan MySQL emas?

• Production bazada schema o‘zgartirish kerak bo‘lsa, qanday yondashasiz?

• Sekin ishlayotgan query chiqsa, uni qanday tezlashtirasiz?

**Jovob:** 

 • MySQL, PostgreSQL, MSSQL, Oracle bular System managmend database yani SQL uchun qulay GUI Interface va barchalari asosan SQL ishlatadi va codida ozgina farqi bor PGSQ Asosan Kottaroq loyhalar uchun qulay 

 • migratsya orqali ozgartiraman lekin production bolsa birinchi staggingda sinovdan otkazaman keyn production ga update qilaman 

 • Debuggbar yoki EXPLAIN ANALYZE ( https://habr.com/ru/articles/203320/ ) bilan querylarni organaman va topilgan seki Query ni tezlashtirish ustida ishlayman 

## Redis


**Savol:**

 • Redis’ni ko‘proq qaysi ishlar uchun qo‘llaysiz: cache, queue, session…?

 • Redis’ni faqat tezkor xotira sifatida ishlatish va diskka yozish orasidagi farqni tushuntirib bera olasizmi?

 • Cache’da ma’lumot eskirib qolsa yoki birdaniga ko‘p so‘rov tushsa, qanday hal qilasiz?

**Jovob:** 

 • redisni asosan cache va queue uchun ishlataman  

 • redisni tezkor hotira va diska yozishtagi farqi hotiradan ochib ketadi serverga bir shikaz yetsa va hotirani asosan man CPU bilan Octane tez ishlashi uchun ishlataman va redis ti cechlarini diska yozgan bolar edim HDD mas SSD sababi SSD tezroq ishlaydi va joyi ham koproq 

 • bazaga yangi malumot kiritilganida Cache ni yangilab olaman asosan malumotlarni cechlash uchun man mana bu package dan foydalanaman ( https://leqc.renoki.org/ ) 

## Docker

**Savol:**

• Laravel loyihasini Docker’da qanday ishga tushirasiz?

• Dockerfile va Docker Compose o‘rtasidagi farqni qanday tushuntirasiz?

• Lokalga to‘g‘ri kelgan konteyner production’da ishlamasa, qanday yo‘l tutasiz?


**Jovob:** 

 • Laravel Sail orqali Docker ishlataman va ./vendor/bin/sail up -d orqali konteynerni ishga tushiraman

 • DockerFile va docker-compose.yml ortasida farq dockerfile bu bizi contaynerni ichiga kerakli depedency tortib oladi va dockerfile bu bita image obraz yaratadi docker-compose bolsa birnecha dockerfile file orqali bir necha contayner yaratib oladi

 •  env faylni va PHP Extensions Composer Dependencies NGINX larni tekshiraman va docker contaynerdi tekshiraman 

## Passport

**Savol:**

• Passport’da tokenlarning turlari bor – masalan personal access va password grant. Ularning farqi nimada?

• API’da rollarga qarab huquqlarni qanday ajratasiz?

• Token’larning xavfsizligini qanday ta’minlaysiz?

**Jovob:** 

 • personal access foydalanuvchi tokeni va password grant foydalanuchi login/parol orqali token oladi

 • Middleware RBAC + Policy lar orqali rollarni tekshiraman va ruhsat berilgan endpointka kirish beraman 

 • HTTPS, shorts-lived tokens, refresh tokens Passport::refreshTokensExpireIn(now()->addDays(15)); va revoke tokens orqali


## Octane


**Savol:**

 • Laravel Octane bilan ishlaganmisiz? U qaysi jihatlari bilan tezroq ishlaydi?

 • Octane’da ishlaganda qanday ehtiyot bo‘lish kerak bo‘ladi (masalan singletonlar bilan)?

 • Production’da Octane’ni qanday kuzatasiz va masshtablashtirasiz?

**Jovob:** 

 • Laravel Octane bu uzida 3 ta server bor RoadRunner, Swoole, FrankenPHP, man asosan RoadRunner ishlataman u Go va C tillarida yozilgan va bu 3 server ichida eng tez ishlaydigan server va server memory da saqlanadi 

 • Singleton yoki static ni togri reset qilish kerak bolmasa eski Request lar qoladi 

 • Horizon, Telescope bilan monitoring va workers kopaytirish va load balancing lekin product ka qoyishtan avval HTTP Load Test qilib olgan yaxshiroq dib oylayman oldinda qanaqangi darajada request larga jovob bera oladi va bu requestlar qancha darajaga chiqsa loyha qotadi shularni oldini olish uchun 

## Amaliy vaziyatlar


**Savol:**

 • Trafik ko‘paygani sari API sekinlashsa, avval nimani tekshirasiz?

 • Docker’da loyiha “Out of Memory” xatosi bersa, qanday choralar ko‘rasiz?
 
 • Mijoz “API’dan 1 soatdan keyin avtomatik chiqib ketayapman” desa,  bunga qanday yechim taklif qilasiz?


**Jovob:** 

 • Server CPU/RAM/NET keyn Database va cachelarni va queue va loglarni koraman 

 • container memory limit oshiraman Docker GUI orqali va swap qishish va ishlatilmay turilgan containerlarni ochiraman va Cachesini tozalayman 

 • Passport::tokensExpireIn(now()->addDays(15)); orqali yoki refresh token 