<div align="center">

# Faculty Monitoring System
The Faculty Monitoring System is a system that will aid the Faculty Staff in managing the details of submitting the required documents, class attendance, and campus activities. It will also provide the campus with automated tools to quickly follow the employee. It is a web application that offers an automated solution for faculty monitoring that is well-organized and improved.

<br>

# Technology Stack
**- LaravelAPI**<br>
**- EloquentORM**<br>
**- MySQL**<br>
**- jQuery**<br>
**- LaravelBlade**<br>
**- Bootstrap**<br>
**- Laravel (Database Seeding, Factory, Migration)**<br>
**- Javascript (Dropzone JS, EnjoyHint)**<br>

</div>

<br><br>

<div align='center'>


</div>



## Installation
Clone the repository
<pre class="notranslate"><code>git clone https://github.com/jrglomar/fms
</code></pre>

Switch to the repo folder
<pre class="notranslate"><code>cd fms
</code></pre>

Install all the dependencies using composer 
<pre class="notranslate"><code>composer install
</code></pre>

Copy the .env.example content and rename it to .env file
<pre class="notranslate"><code>cp .env.example .env
</code></pre>

Generate a new application key
<pre class="notranslate"><code>php artisan key:generate
</code></pre>

<!-- 
Generate a new JWT authentication secret key
<pre class="notranslate"><code>php artisan jwt:generate
</code></pre>
Copy the example env file and make the required configuration changes in the .env file
<pre class="notranslate"><code>cp .env.example .env
</code></pre> -->

Run the database migrations (Set the database connection in .env before migrating)  
<pre class="notranslate"><code>php artisan migrate:fresh --seed
</code></pre>

Start the local development server
<pre class="notranslate"><code>php artisan serve
</code></pre>

## Login at APP_URL/login to setup system
<div>
    <table>
        <thead>
            <tr>
                <th><strong>Email</strong></th>
                <th><strong>Password</strong></th>
                <th><strong>Role</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>admin@pupqc.com</td>
                <td>User01</td>
                <td>Admin</td>
            </tr>
            <tr>
                <td>acadhead@pupqc.com</td>
                <td>User01</td>
                <td>Academic Head</td>
            </tr>
            <tr>
                <td>faculty@pupqc.com</td>
                <td>User01</td>
                <td>Faculty</td>
            </tr>
            <tr>
                <td>faculty2@pupqc.com</td>
                <td>User01</td>
                <td>Faculty</td>
            </tr>
            <tr>
                <td>director@pupqc.com</td>
                <td>User01</td>
                <td>Director</td>
            </tr>
            <tr>
                <td>checker@pupqc.com</td>
                <td>User01</td>
                <td>Checker</td>
            </tr>
        </tbody>
    </table>
</div>
