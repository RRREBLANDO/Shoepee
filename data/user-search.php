<?php
    include_once '../partials/connectionString.php';
    $search_string = mysqli_real_escape_string($conn, $_POST['search_string']);
    if(!empty($search_string)){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.address, u.age, u.phone_number, u.email, r.role_name  FROM users u JOIN roles r ON u.role_id = r.id WHERE u.firstname LIKE '%{$search_string}%' OR u.lastname LIKE '%{$search_string}%' OR r.role_name LIKE '%{$search_string}%'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                echo '<tr>
                        <td><img src="../assets/user-profiles/profile-'.$row['id'].'.jpg" alt=""></td>
                        <td class="user-fname">'.$row['firstname'].'</td>
                        <td class="user-lname">'.$row['lastname'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.$row['age'].'</td>
                        <td>'.$row['phone_number'].'</td>
                        <td>'.$row['email'].'</td>
                        <td style="text-transform: capitalize">'.$row['role_name'].'</td>
                        <td>
                            <button class="btn btn-sm delete-user" data-target="delete-user-dialog" value="'.$row['id'].'"><i class="bx bx-trash-alt"></i></button>
                        </td>
                    </tr>';
            }
        } else {
            echo "No records found";
        }
    } else{
        $sql1 = "SELECT u.id, u.firstname, u.lastname, u.address, u.age, u.phone_number, u.email, r.role_name  FROM users u JOIN roles r ON u.role_id = r.id";
        $query1 = mysqli_query($conn, $sql1);
        while($row = mysqli_fetch_assoc($query1)){
            echo '<tr>
                    <td><img src="../assets/user-profiles/profile-'.$row['id'].'.jpg" alt=""></td>
                    <td class="user-fname">'.$row['firstname'].'</td>
                    <td class="user-lname">'.$row['lastname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['age'].'</td>
                    <td>'.$row['phone_number'].'</td>
                    <td>'.$row['email'].'</td>
                    <td style="text-transform: capitalize">'.$row['role_name'].'</td>
                    <td>
                        <button class="btn btn-sm delete-user" data-target="delete-user-dialog" value="'.$row['id'].'"><i class="bx bx-trash-alt"></i></button>
                    </td>
                </tr>';
        }
    }
?>