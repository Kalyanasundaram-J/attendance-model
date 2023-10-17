<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid text-center">
        <div class="border border-2 border-primary my-3 p-3 rounded">
            <form method="post">
                <div class="row">
                    <div class="col-12 mb-2 text-start text-secondary"><h5>Filter Data using Class Name/Student Name</h5><hr class="border border-1 border-primary"></div>

                    <div class="col-12 col-md-4 mb-2">
                        <input type="text" class="form-control border border-primary" placeholder="Class Name" aria-label="Class Name" name="className">
                    </div>
                    <div class="col-12 col-md-4 mb-2">
                        <input type="text" class="form-control border border-primary" placeholder="Student Name" aria-label="Student Name" name="studentName">
                    </div>
                    <div class="col-12 col-md-4 text-center mb-2">
                        <input type="submit" class="btn btn-primary" aria-label="submit button">
                    </div>
                </div>
            </form>
        </div>
        <div class="border-start border-5 border-primary p-0 rounded my-3 overflow-auto">
            <table class="table table-bordered border border-secondary-subtle rounded my-0" id="">
                <thead>
                    <tr>
                        <th class="text-secondary">S.No</th>
                        <th class="text-secondary">Week Number</th>
                        <th class="text-secondary">Week Commencing</th>
                        <th class="text-secondary">Student</th>
                        <th class="text-secondary">Monday</th>
                        <th class="text-secondary">Tuesday</th>
                        <th class="text-secondary">Wednesday</th>
                        <th class="text-secondary">Thursday</th>
                        <th class="text-secondary">Friday</th>
                        <th class="text-secondary">Weekly Attendance</th>
                        <th class="text-secondary">Weekly Absence</th>
                        <th class="text-secondary">Classes</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-primary">
                    <?php
                        require('./../controller/BaseClass.php');
                        require('./../controller/AttendanceClass.php');
                        require('./../controller/ClassClass.php');
                        require('./../controller/StudentClass.php');
                        require('./../model/attendance.php');

                        if(isset($_POST['week_number'],$_POST['week_commencing'],$_POST['student_id'],$_POST['monday_status'],$_POST['tuesday_status'],$_POST['wednesday_status'],$_POST['thursday_status'],$_POST['friday_status'],$_POST['class_id'])){

                            $attendanceModel = new AttendanceModel();
                            $attendanceModel->week_number = $_POST['week_number'];
                            $attendanceModel->week_commencing = $_POST['week_commencing'];
                            $attendanceModel->student_id = $_POST['student_id'];
                            $attendanceModel->monday_status = $_POST['monday_status'];
                            $attendanceModel->tuesday_status = $_POST['tuesday_status'];
                            $attendanceModel->wednesday_status = $_POST['wednesday_status'];
                            $attendanceModel->thursday_status = $_POST['thursday_status'];
                            $attendanceModel->friday_status = $_POST['friday_status'];
                            $attendanceModel->class_id = $_POST['class_id'];
                            $attendanceInsertObject = new AttendanceClass();
                            $attendanceInsertObject->insert_attendance($attendanceModel);
                        }

                        $studentList = $student_object->get_student_list();
                        $classList = $class_object->get_class_list();
                        $className = null;
                        $studentName = null;
                        if (isset($_POST['className'])) {
                            $className = $_POST['className'];
                        }
                        if (isset($_POST['studentName'])) {
                            $studentName = $_POST['studentName'];
                        }
                        $attendanceObject = new AttendanceClass();
                        $attendanceList = $attendanceObject->get_attendance($studentName,$className);
                        if ($attendanceList AND $attendanceList->num_rows > 0) {
                            $s_number = 1;
                            while ($row = $attendanceList->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='p-3 text-secondary'>".$s_number."</td>";
                                echo "<td class='p-3 text-secondary'> Week " . $row["week_number"] . "</td>";
                                echo "<td class='p-3 text-secondary'>" . date("d M Y", strtotime($row["week_commencing"])) . "</td>";
                                echo "<td class='p-3 text-secondary' data-bs-trigger='hover' data-bs-toggle='popover' data-bs-title='".$row["student_name"]."' data-bs-content='Email: ".$row["student_email"]."'>" . $row["student_name"] . "</td>";
                                echo "<td class='p-3 ".(($row["monday_status"]=='1')?'text-bg-success':(($row["monday_status"]=='Late')?'bg-success-subtle text-secondary':'bg-danger-subtle text-secondary'))."'>" . ($row["monday_status"]=='Late'?'0.5':$row["monday_status"]) . "</td>";
                                echo "<td class='p-3 ".(($row["tuesday_status"]=='1')?'text-bg-success':(($row["tuesday_status"]=='Late')?'bg-success-subtle text-secondary':'bg-danger-subtle text-secondary'))."'>" . ($row["tuesday_status"]=='Late'?'0.5':$row["tuesday_status"]) . "</td>";
                                echo "<td class='p-3 ".(($row["wednesday_status"]=='1')?'text-bg-success':(($row["wednesday_status"]=='Late')?'bg-success-subtle text-secondary':'bg-danger-subtle text-secondary'))."'>" . ($row["wednesday_status"]=='Late'?'0.5':$row["wednesday_status"]) . "</td>";
                                echo "<td class='p-3 ".(($row["thursday_status"]=='1')?'text-bg-success':(($row["thursday_status"]=='Late')?'bg-success-subtle text-secondary':'bg-danger-subtle text-secondary'))."'>" . ($row["thursday_status"]=='Late'?'0.5':$row["thursday_status"]) . "</td>";
                                echo "<td class='p-3 ".(($row["friday_status"]=='1')?'text-bg-success':(($row["friday_status"]=='Late')?'bg-success-subtle text-secondary':'bg-danger-subtle text-secondary'))."'>" . ($row["friday_status"]=='Late'?'0.5':$row["friday_status"]) . "</td>";
                                echo "<td class='p-3 text-success'><strong>" . ($row["weekly_attendance"]==(int)$row["weekly_attendance"]? (int)$row["weekly_attendance"] : $row["weekly_attendance"]) . " </strong><small>days</small></td>";
                                echo "<td class='p-3 text-danger'><strong>" . ($row["weekly_absence"]==(int)$row["weekly_absence"]? (int)$row["weekly_absence"]:$row["weekly_absence"]) . " </strong><small>days</small></td>";
                                echo "<td class='p-3 text-secondary'><span class='badge rounded-pill border border-primary text-secondary'>" . $row["class_name"] . "</span></td>";
                                echo "</tr>";
                                $s_number += 1;
                            }
                        } else {
                            echo "<tr><td colspan='12'>No students attendance found.</td></tr>";
                        }
                    ?>
                    <tr>
                        <td></td>
                        <td class="ps-2 text-start text-secondary user-select-none" colspan="11" style="cursor:pointer" id="addWeekNumber" data-bs-toggle="modal" data-bs-target="#addAttendance">
                            + Add Week Number
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Attendance submit model -->
        <div class="modal fade" id="addAttendance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"    aria-labelledby="addAttendanceLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addAttendanceLabel">Add Attendance Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="weekNumber">Week Number</span>
                            <input type="number" class="form-control form-control-sm " placeholder="week number" aria-label="Week Number" aria-describedby="weekNumber" name="week_number">
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="weekCommencing">Week Commencing</span>
                            <input type="date" class="form-control form-control-sm " placeholder="week commencing" aria-label="Week Commencing" aria-describedby="weekCommencing" name="week_commencing">
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="student">Student</span>
                            <select class="form-select" aria-label="student" aria-describedby="student" name="student_id">
                                <option selected value='' disabled>Select Student </option>
                                <?php

                                if($studentList AND $studentList->num_rows > 0){
                                    while($row = $studentList->fetch_assoc()) {
                                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    }
                                }

                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="mondayStatus">Monday</span>
                            <select class="form-select" aria-label="Monday" aria-describedby="Monday" name="monday_status">
                                <option selected value='' disabled>Select Status </option>
                                <option value="1">1</option>
                                <option value="Late">Late</option>
                                <option value="Absent">Absent</option>
                                <option value="Sickday">Sickday</option>
                                <option value="Vacation">Vacation</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="tuesdayStatus">Tuesday</span>
                            <select class="form-select" aria-label="Tuesday" aria-describedby="Tuesday" name="tuesday_status">
                                <option selected value='' disabled>Select Status </option>
                                <option value="1">1</option>
                                <option value="Late">Late</option>
                                <option value="Absent">Absent</option>
                                <option value="Sickday">Sickday</option>
                                <option value="Vacation">Vacation</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="wednesdayStatus">Wednesday</span>
                            <select class="form-select" aria-label="Wednesday" aria-describedby="Wednesday" name="wednesday_status">
                                <option selected value='' disabled>Select Status </option>
                                <option value="1">1</option>
                                <option value="Late">Late</option>
                                <option value="Absent">Absent</option>
                                <option value="Sickday">Sickday</option>
                                <option value="Vacation">Vacation</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="thursdayStatus">Thursday</span>
                            <select class="form-select" aria-label="Thursday" aria-describedby="Thursday" name="thursday_status">
                                <option selected value='' disabled>Select Status </option>
                                <option value="1">1</option>
                                <option value="Late">Late</option>
                                <option value="Absent">Absent</option>
                                <option value="Sickday">Sickday</option>
                                <option value="Vacation">Vacation</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="fridayStatus">Friday</span>
                            <select class="form-select" aria-label="Friday" aria-describedby="Friday" name="friday_status">
                                <option selected value='' disabled>Select Status </option>
                                <option value="1">1</option>
                                <option value="Late">Late</option>
                                <option value="Absent">Absent</option>
                                <option value="Sickday">Sickday</option>
                                <option value="Vacation">Vacation</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 border border-secondary rounded">
                            <span class="input-group-text" id="className">Class Name</span>
                            <select class="form-select" aria-label="class Name" aria-describedby="className" name="class_id">
                                <option selected value='' disabled>Select Class </option>
                                <?php
                                if($classList AND $classList->num_rows > 0) {
                                    while ($row=$classList->fetch_assoc()) {
                                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-sm btn-success">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
    </script>
</body>
</html>