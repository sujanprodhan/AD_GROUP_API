
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

http://localhost:8000/api/auth/profile?

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

{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "label": "Cameron",
            "ip": "105.71.175.208",
            "description": "Veniam recusandae ad non. Repellendus non autem maiores nisi dolorum cupiditate quia. Libero dolorum temporibus non accusamus excepturi vero vero.",
            "created_at": "2021-10-20 05:31:46",
            "updated_at": "2021-10-20 05:31:46"
        },
		...
	]
}

-----------------------------
| Add new IP 
-----------------------------
Method: Post
URL: http://localhost:8000/api/ip-list

Data: {label: 'Ad-Group', ip:'161.102.211.204', 'description':'text')
#Result:
{
    "status": true,
    "message": "Successfully save new ip."
}


-------------------------
| Update IP label
--------------------------
Method: PUT

# URL : http://localhost:8000/api/ip-list/update

Param: {label: 'new label', id: ip_id }


--------------------------
| Get Audits List 
--------------------------
Method: Get

URL: http://localhost:8000/api/ip-list/show

Result: 
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "ip_id": 12,
            "operation_type": "add",
            "created_at": "2021-10-20 06:02:41",
            "updated_at": "2021-10-20 06:02:41",
            "description": null
        },
		...
	]
}




