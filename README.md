
## About AD Group API 
#Install laravel, composer and others dev setting

## Open Postman:
------------------
1. Check login :
------------------

URL:  http://localhost:8000/api/auth/login
Method: Post
Param: 
---------------------------
email:sujanitbd@gmail.com
pass: 123456

--------------------
|2 Profile API:
--------------------
Method: Get

http://localhost:8000/api/auth/profile?token='token-value.....'

Data: 
{
    "id": 1,
    "name": "MD SUJAN MIAH",
    "email": "sujanitbd@gmail.com",
    "email_verified_at": "2021-10-19T08:57:18.000000Z",
    "created_at": "2021-10-19T08:57:18.000000Z",
    "updated_at": "2021-10-19T08:57:18.000000Z"
}


--------------------------
| Register New User
---------------------------
Method: post

http://localhost:8000/api/auth/register?name=New User&email=newuser@gmail.com&password=pass1234&password_confirmation=pass1234
{
    "message": "User created successfully",
    "user": {
        "name": "New User",
        "email": "newuser@gmail.com",
        "updated_at": "2021-10-19T16:01:36.000000Z",
        "created_at": "2021-10-19T16:01:36.000000Z",
        "id": 11
    }
}


---------------------------
| Get IP Lists 
---------------------------
Method: Get

http://localhost:8000/api/ip-list

[
    {
        "id": 1,
        "label": "Erwin",
        "ip": "147.196.206.230",
        "description": "Maiores unde eius ipsum aut expedita aspernatur quis et. Nobis voluptas ut et placeat ducimus provident velit. Itaque sit autem aut eum similique repudiandae voluptatem.",
        "created_at": "2021-10-19 08:57:28",
        "updated_at": "2021-10-19 08:57:28"
    },
	....

}





