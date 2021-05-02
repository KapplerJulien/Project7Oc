# Project 7 for OpenClassrooms

## Context 

This is an API. 

You have companies. Each company can have clients and each client can have phone. That's all for the database. With this API, you can see all the products and clients. 
But you also can see one by one. If you want to see one client in particular, it's possible. You can add them and of course delete clients. For products, you can update them. 

/!\ : It's a project for my formation. So, I know some stuff is missing. Like add a company, delect a product. Simple things, but don't forget, I followed the project. Thanks !

## Installation  

If you want to download and install this project, you can download the ZIP or if you have Git installed, you can use GitClone command. 

ZIP / Git clone : At the top of the page, you can see a green button named "code", click on it and you'll have everything you want. 

[Git](https://git-scm.com/downloads)

Don't forgot to have Symfony : [Symfony](https://symfony.com/doc/current/index.html).

## Database

Now that you get the Project, you'll to be care about one thing : database. For my project, I used WAMPServer, so obviously, MySQL. Maybe you don't use MySQL, don't worry. 
You can change it in the .env (MyProject/.env). All the information about the database is in this file. 

Then you can open a terminal, go to your project with the command "cd", when you're in, use : php bin/console doctrine:database:create. That will create the database. 

php bin/console make:migration

php bin/console doctrine:migrations:migrate

And you have your database. 

If you want some test, use this command, I write a file with some test inside : php bin/console doctrine:fixtures:load.

## Test 

After all of that, you can finally test the API. So, before, you need to start the Symfony server. Command : symfony server:start

Then, personally, I like Postman when I need to test. If you want to use it [Postman](https://www.postman.com/)

### Example 

I will show you some example. You have 2 choices because : you can test everything with Postman or after the connection (and get the token) you can test in the API. 
I make a documentation of the API and you can test from it. Route : (your localhost adress, If you don't change it : localhost:8000)/api/doc

User test : 

Pseudo : Locami
Password : password0

Pseudo : Vreelodie
Password : password1

Pseudo : Greffoldy
Password : password2

Pseudo : Crompangie
Password : password3

Pseudo : Polcaloid
Password : password4

And you can connect like this with Postman : 

![Connection API Postman](https://i.imgur.com/lThjIzA.png)

I will demonstrate with the doc now, so If you want to test with Postman, there is amazing tuto, you can find it on google. 

So, there is a green button at the top right of the doc, click on it and we will register our token that Postman send.

When you click on a URL to test, don't forget to click on the button "try it out", if you don't click it, you'll not be able to test.

Get details of one phone : 

![GetPhone execute](https://i.imgur.com/JsPudeg.png)

![GetPhone response](https://i.imgur.com/nvZtywc.png)

Phone index : 

![PhoneIndex execute](https://i.imgur.com/oq4RfbR.png)

![PhoneIndex response](https://i.imgur.com/9E99iyn.png)

Phone edit : 

![PhoneEdit execute](https://i.imgur.com/yMuxMJm.png)

![PhoneEdit response](https://i.imgur.com/ssgGiX5.png)

Get details of one user : 

![UserDetails execute](https://i.imgur.com/DPu1dEv.png)

![UserDetails response](https://i.imgur.com/mwH72dX.png)

User index : 

![UserIndex execute](https://i.imgur.com/LW1Y1ql.png)

![UserIndex response](https://i.imgur.com/TEspbab.png)

Delete user : 

![UserDelete execute](https://i.imgur.com/0jVRIKi.png)

![UserDelete response](https://i.imgur.com/wDrOrRk.png)

Add user : 

![UserDelete execute](https://i.imgur.com/rXVtA6R.png)

![UserDelete response](https://i.imgur.com/ofwoMD6.png)

## Library 

### NelmioApiDocBundle

[NelmioApiDocBundle](https://symfony.com/doc/4.x/bundles/NelmioApiDocBundle/index.html)