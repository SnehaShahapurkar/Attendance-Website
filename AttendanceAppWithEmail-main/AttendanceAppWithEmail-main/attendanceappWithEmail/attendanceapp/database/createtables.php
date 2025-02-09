<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . "/attendanceapp/database/database.php";
function clearTable($dbo, $tabName)
{
  $c = "delete from ".$tabName;
  $s = $dbo->conn->prepare($c);
  try {
    $s->execute();
    echo($tabName." cleared");
  } catch (PDOException $oo) {
    echo($oo->getMessage());
  }
}
$dbo = new Database();
$c = "create table student_details
(
    id int auto_increment primary key,
    roll_no varchar(20) unique,
    name varchar(50),
    email_id varchar(100)
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>student_details created");
} catch (PDOException $o) {
  echo ("<br>student_details not created");
}

$c = "create table course_details
(
    id int auto_increment primary key,
    code varchar(20) unique,
    title varchar(50),
    credit int
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>course_details created");
} catch (PDOException $o) {
  echo ("<br>course_details not created");
}


$c = "create table faculty_details
(
    id int auto_increment primary key,
    user_name varchar(20) unique,
    name varchar(100),
    password varchar(50)
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>faculty_details created");
} catch (PDOException $o) {
  echo ("<br>faculty_details not created");
}


$c = "create table session_details
(
    id int auto_increment primary key,
    year int,
    term varchar(50),
    unique (year,term)
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>session_details created");
} catch (PDOException $o) {
  echo ("<br>session_details not created");
}



$c = "create table course_registration
(
    student_id int,
    course_id int,
    session_id int,
    primary key (student_id,course_id,session_id)
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>course_registration created");
} catch (PDOException $o) {
  echo ("<br>course_registration not created");
}
clearTable($dbo, "course_registration");

$c = "create table course_allotment
(
    faculty_id int,
    course_id int,
    session_id int,
    primary key (faculty_id,course_id,session_id)
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>course_allotment created");
} catch (PDOException $o) {
  echo ("<br>course_allotment not created");
}
clearTable($dbo, "course_allotment");

$c = "create table attendance_details
(
    faculty_id int,
    course_id int,
    session_id int,
    student_id int,
    on_date date,
    status varchar(10),
    primary key (faculty_id,course_id,session_id,student_id,on_date)
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>attendance_details created");
} catch (PDOException $o) {
  echo ("<br>attendance_details not created");
}
clearTable($dbo, "attendance_details");

$c = "create table sent_email_details
(
    faculty_id int,
    course_id int,
    session_id int,
    student_id int,
    on_date date,
    id int auto_increment primary key,
    message varchar(200),
    to_email varchar(100)
)";
$s = $dbo->conn->prepare($c);
try {
  $s->execute();
  echo ("<br>sent_email_details created");
} catch (PDOException $o) {
  echo ("<br>sent_email_details not created");
}
clearTable($dbo, "sent_email_details");

clearTable($dbo, "student_details");
$c = "insert into student_details
(id,roll_no,name,email_id)
values

(1,'21CS001','Akash','akash@gmail.com'),
(2,'21CS002','Abhi','Abhi@gmail.com'),
(3,'21CS003','Arun','Arun@gmail.com'),
(4,'21CS101','Ranjeeta C','ranjeeta@gmail.com'),
(5,'21CS103','Rasool Nadaf','rasoolnadaf1918@gmail.com'),
(6,'21CS130','Sagar','rasoolnadaf1918@gmail.com'),
(7,'21CS131','Shashikala M','shashikalm@gmail.com'),
(8,'21CS136','Santhosh','santhosh@gmail.com'),
(9,'21CS150','Sneha S','snehashahapurkar708@gmail.com'),
(10,'21CS160','Vaibhav','vaibhav@gmail.com')
";

$s = $dbo->conn->prepare($c);
try {
  $s->execute();
} catch (PDOException $o) {
  echo ("<br>duplicate entry");
}

clearTable($dbo, "faculty_details");
$c = "insert into faculty_details
(id,user_name,password,name)
values
(1,'prasad','123','Mr.Prasad Mahapati'),
(2,'megha','123','Mrs Megha'),
(3,'vijayalaxmi','123','Mrs Vijaylaxmi J')";


$s = $dbo->conn->prepare($c);
try {
  $s->execute();
} catch (PDOException $o) {
  echo ("<br>duplicate entry");
}

clearTable($dbo, "session_details");
$c = "insert into session_details
(id,year,term)
values
(1,2024,'SEMESTER 2'),
(2,2024,'SEMESTER 4'),
(3,2024,'SEMESTER 6')";

$s = $dbo->conn->prepare($c);
try {
  $s->execute();
} catch (PDOException $o) {
  echo ("<br>duplicate entry");
}

clearTable($dbo, "course_details");
$c = "insert into course_details
(id,title,code,credit)
values
  (1,'Database management system','CO321',4),
  (2,'Pattern Recognition','CO215',3),
  (3,'ARTIFICIAL INTELLIGENCE','CS670',4)";

$s = $dbo->conn->prepare($c);
try {
  $s->execute();
} catch (PDOException $o) {
  echo ("<br>duplicate entry");
}

//if any record already there in the table delete them
clearTable($dbo, "course_registration");
$c = "insert into course_registration
  (student_id,course_id,session_id)
  values
  (1,1,1),
  (1,2,2),
  (1,3,3),
  (2,1,1),
  (2,2,2),
  (2,3,3),
  (3,1,1),
  (3,2,2),
  (3,3,3),
  (4,1,1),
  (4,2,2),
  (4,3,3),
  (5,1,1),
  (5,2,2),
  (5,3,3),
  (6,1,1),
  (6,2,2),
  (6,3,3),
  (7,1,1),
  (7,2,2),
  (7,3,3),
  (8,1,1),
  (8,2,2),
  (8,3,3),
  (9,1,1),
  (9,2,2),
  (9,3,3),
  (10,1,1),
  (10,2,2),
  (10,3,3)";

  $s = $dbo->conn->prepare($c);
  try {
    $s->execute();
  } catch (PDOException $o) {
    echo ("<br>duplicate entry");
  }

//if any record already there in the table delete them
clearTable($dbo, "course_allotment");
$c = "insert into course_allotment
  (faculty_id,course_id,session_id)
  values
  (1,1,1),
  (1,1,2),
  (1,1,3),
  (2,2,1),
  (2,2,2),
  (2,2,3),
  (3,3,1),
  (3,3,2),
  (3,3,3)";
  $s = $dbo->conn->prepare($c);
  try {
    $s->execute();
  } catch (PDOException $o) {
    echo ("<br>duplicate entry");
  }
