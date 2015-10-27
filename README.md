## TAVOO API
Current repository contains the files for the API of [TAVOO](https://github.com/gkffzs/TAVOO). The use of the "API" term may be an overkill, as the above are only mostly simple PHP files that handle the communication with the database on the server. But still, it is the communication layer between the mobile application and the database.

#### Functionalities
Each file is used for a different functionality of the application. More particularly:

*(to be updated)*

#### Database
The structure of the database is pretty simple, too. It consists of 5 tables, with a few interconnections among them. There is a table called **users** (that stores the basic information about the registered users), a table called **locations** (that stores the basic information about the locations that are suitable for meetings and play), a table called **ratings** (which contains a user's rating for a location), a table called **checked** (that contains information on the location of a user who has performed check-in), and finally, a table called **logs** (which is used for storing various information about the activity of the users in the pre-alpha version of the application).

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

```mysql
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `password` varchar(256) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;
```

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

```mysql
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `address` varchar(128) COLLATE utf8_bin NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;
```

<table>
    <tr>
      <td colspan='3'><b>ratings</b></td>
    </tr>
    <tr>
      <td><b>user_id</b></td>
      <td><b>location_id</b></td>
      <td><b>rating</b></td>
    </tr>
    <tr>
      <td>int(11)</td>
      <td>int(11)</td>
      <td>int(2)</td>
    </tr>
</table>

```mysql
CREATE TABLE IF NOT EXISTS `ratings` (
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
```

<table>
    <tr>
      <td colspan='3'><b>checked</b></td>
    </tr>
    <tr>
      <td><b>user_id</b></td>
      <td><b>location_id</b></td>
    </tr>
    <tr>
      <td>int(11)</td>
      <td>int(11)</td>
    </tr>
</table>

```mysql
CREATE TABLE IF NOT EXISTS `checked` (
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
```

<table>
    <tr>
      <td colspan='5'><b>logs</b></td>
    </tr>
    <tr>
      <td><b>user_id</b></td>
      <td><b>activity_tag</b></td>
      <td><b>action_tag</b></td>
      <td><b>related_id</b></td>
      <td><b>action_timestamp</b></td>
    </tr>
    <tr>
      <td>int(11)</td>
      <td>varchar(64)</td>
      <td>varchar(64)</td>
      <td>int(11)</td>
      <td>timestamp</td>
    </tr>
</table>

```mysql
CREATE TABLE IF NOT EXISTS `logs` (
  `user_id` int(11) NOT NULL,
  `activity_tag` varchar(64) COLLATE utf8_bin NOT NULL,
  `action_tag` varchar(64) COLLATE utf8_bin NOT NULL,
  `related_id` int(11) NOT NULL,
  `action_timestamp` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
```

#### Instructions
In order to have this API set on the server, some things need to be taken care of first. *(to be updated)*
