# Students Information System

This is a simple <i>CREATE</i>, 
<i>READ</i>, <i>UPDATE</i>,
 <i>and DELETE</i> <i>CRUD</i> application.
<i>Laravel</i> 5 for the backend 
and <i>AngularJS</i> for the front end are used.

<i>Basic Usage</i>

User inputs student
<ul>
    <li>
       Name, email, faculty, major
    </li>
    <li>
       Selects admission date
    </li>
    <li>
        Selects country
    </li>
    <li>
      Selects subject(multiple selection possibility)
    </li>
    <li>
        Uploads a file
    </li>
</ul>

## Prerequisites
<ul>
    <li>
       Laravel 5
    </li>
    <li>
       Apache
    </li>
    <li> 
       MySQL
    </li>
    <li>
       PHP, Composer installed.
    </li>
</ul>

## Used Technologies
<ul>
  <li>
     Twitter bootstrap
  </li>
  <li>
    AngularJS wrapper for select2 
  </li>
</ul>

## Run the site
 After you have cloned or downloaded the project, navigate to the corresponding directory
  <ul>
     <li>
     Install all the dependencies as specified in the <i>composer.lock</i> file (in your terminal). <br/>
     cd laravel-angular-app <br/>
     composer install 
     </li>
     <li>Copy the <i>.env.example</i> file to the <i>.env</i> file, and set the corresponding keys</li>
     <li> Run the site <br/> php artisan serve --host=your_host --port=your_port <br/> Alternatively, create a virtual host. <br/>
     </li>
     <li>Execute the <i>migrations</i> and run the <i>seeders</i> <br/> php artisan migrate
     </li>
  </ul>

 ![ScreenShot](https://i.imgur.com/wZO9h32.png)
 ![ScreenShot](https://i.imgur.com/556ozxe.png) 
 
 
