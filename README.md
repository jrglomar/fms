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

- Copy all files inside readme/ext folder to your
xampp/php/ext

- Modify your php.ini 
Find extension=pdo_sqlite
Make a new line and add this lines:
extension=php_sqlsrv_74_nts_x64.dll
extension=php_sqlsrv_74_ts_x64.dll

- Run the database script in the folder using ssms.
Version to download
SQL SERVER 2014
https://www.microsoft.com/en-sg/download/confirmation.aspx?id=42299

XAMPP VERSION 7.4.12
https://www.apachefriends.org/download.html

OPTIONAL:
SSMS 2018:
https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms?view=sql-server-ver15

- If run locally to access the homepag - http://localhost/eboto/

## Login to browse the system
<div>
    <table>
        <thead>
            <tr>
                <th><strong>Student Number</strong></th>
                <th><strong>Password</strong></th>
                <th><strong>Role</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>admin</td>
                <td>admin</td>
                <td>Admin</td>
            </tr>
            <tr>
                <td>2018-00232-CM-0</td>
                <td>admin</td>
                <td>Student</td>
            </tr>
        </tbody>
    </table>
</div>

