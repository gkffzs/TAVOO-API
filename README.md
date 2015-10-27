## TAVOO API
Current repository contains the files for the API of [TAVOO](https://github.com/gkffzs/TAVOO). The use of the "API" term may be an overkill, as the above are only mostly simple PHP files that handle the communication with the database on the server. But still, it is the communication layer between the mobile application and the database.

#### Functionalities
Each file is used for a different functionality of the application. More particularly:

*(to be updated)*

#### Database
The structure of the database is pretty simple, too. It consists of 5 tables, with plain interconnections among them. There is a table called **users**, that stores the basic information about the registered users, a table called **locations**, that stores the basic information about the locations that are suitable for meetings and play,... *(to be updated)*

<table>
    <tr>
      <td colspan='3'><b>users</b></td>
    </tr>
    <tr>
      <td><b>id*</b></td>
      <td><b>username</b></td>
      <td><b>password</b></td>
    </tr>
    <tr>
      <td>int(11)</td>
      <td>varchar(64)</td>
      <td>varchar(64)</td>
    </tr>
</table>

<table>
    <tr>
      <td colspan='5'><b>locations</b></td>
    </tr>
    <tr>
      <td><b>id*</b></td>
      <td><b>name</b></td>
      <td><b>address</b></td>
      <td><b>lat</b></td>
      <td><b>lng</b></td>
    </tr>
    <tr>
      <td>int(11)</td>
      <td>varchar(64)</td>
      <td>varchar(128)</td>
      <td>float(10,6)</td>
      <td>float(10,6)</td>
    </tr>
</table>

