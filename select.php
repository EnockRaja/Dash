<?php 

echo ' <tr>
          <th>STUDENT ID</th>
          <th>NAME</th>
          <th>COLLEGE NAME</th>
          <th>AAAA</th>
          <th>EDIT</th>
          <th>DELETE</th>
          <th>DOWNLOAD</th>
      </tr>';
include('db.php');
$select ="SELECT * FROM `student`";
$result = $connect->query($select);
while($row = $result->fetch_assoc()){
    echo ' <tr id="'.$row['id'].'">
             <td style="color:black">'.$row['id'].'</td>
             <td>'.$row['name'].'</td>
             <td style="color:black">'.$row['college'].'</td>
             <td><img id="table_img" src="'.$row['image'].'" width="70" height="70" style="border-radius:3px;display:block;margin:auto"/></td>
             <td data-id="'.$row['id'].'" class="edit">EDIT</td>
             <td data-id="'.$row['id'].'" class="delete">DELETE</td>
             <td data-id="'.$row['id'].'" class="download"><i class="fa-solid fa-download"></i></td>
          </tr>';
}
?>