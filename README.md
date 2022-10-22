#steps to use this app

Step1> composer install
Step2> insert details of sql in .env file
Step3>php artisan migrate
step4> php artisan db:seed



#end point

Create an API with Laravel project that creates the report store it in local folder. Send
response as final destination of the file.

{{App_url}}/api/report/generator


Create a one more GET API that takes input as file name and that api should download the
specific file.


{{App_url}}/api/report/filename



