<?php 
$con = mysqli_connect('localhost','root','','user');
if(!$con){
    die("connection failed".mysqli_connect_error());
}
// counting all the user 
$sql = "SELECT COUNT(*) as total_count FROM `users`";
$result = mysqli_query($con, $sql);

// Fetch the result as an associative array
$row = mysqli_fetch_assoc($result);

// Get the total count from the array
$totalnumber = $row["total_count"];

// Output the total number
// counting active students
$sqlstudent = "SELECT COUNT(*) as total_student FROM `users` WHERE `status` = '0'";
$resultstudent = mysqli_query($con, $sqlstudent);

// Fetch the result as an associative array
$rowstudent = mysqli_fetch_assoc($resultstudent);

// Get the total count from the array
$totalstudents = $rowstudent["total_student"];

//counting all the professor
$sqlprofessor = "SELECT COUNT(*) as total_professor FROM `users` WHERE `status` = '1'";
$resultprofessor = mysqli_query($con, $sqlprofessor);
$rowprofessor = mysqli_fetch_assoc($resultprofessor);
$totalprofessor = $rowprofessor["total_professor"];

$sqlapplicants = "SELECT COUNT(*) as total_applicant FROM `users` WHERE `status` = '2'";
$resultapplicants = mysqli_query($con, $sqlapplicants);
$rowapplicants = mysqli_fetch_assoc($resultapplicants);
$totalapplicants = $rowapplicants["total_applicant"];

// para sa mga reported na videos
$con = mysqli_connect("localhost", "root", "", "course_creation");

$sql = "SELECT COUNT(*) as total_count FROM `videolessons` where `status` = '0'";

$result = mysqli_query($con, $sql);

// Fetch the result as an associative array
$row = mysqli_fetch_assoc($result);

// Get the total count from the array
$totalvideoreport = $row["total_count"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



</head>
<style>
    .dashboard-container{
        width: 100%;
        height: 100vh;
        background-color: #f0f0f0;
        display: grid;
        grid-template-columns:repeat(6, 1fr);
        grid-template-rows: repeat(3, 1fr);
        gap: 22px;
        
    }.admin-div{
        grid-column: 1/span 2;
    }.todays-div{
        grid-row: 2/span 2;
        overflow: auto;
    }.graph-div{
        grid-column: 2/span 3;
        grid-row: 2/span 2;
    }.calendar-div{
        grid-column: 5/span 2;
    }.notes-div{
        grid-column: 5/span 2;
        height: 400px;
        overflow: auto;
        

    }#time{
        font-size: 40px;
    }#date{
        font-size: 14px;
    }.admin-div{
        padding: 20px;
        background-color: #0D0A0B;
        color: #F3EFF5;
        border-radius: 10px;
        padding-left: 25px;
    }.today-item{
        background-color: #F3EFF5;
        color: #0D0A0B;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        width: 174px;
        height: 100px;
     ;
    }.todays-div{
        align-items: center;
        display: flex;
        flex-direction: column;
        gap: 42px;
    }.notes-container{
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
        height: 100%;
        

    }.notes-item{
        background-color: #F3EFF5;
        color: #0D0A0B;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        width: auto;
        height: 10px;
        display: block;
    }.add-notes{
        margin-bottom: 10px;
        left: 0;
        margin-left: 80%;
        border-radius: 50%;
        color: #72B01D;
        width: 25px;
        height: 25px;
        border: 1px solid #72B01D;
        cursor: pointer;
    }.notes-item{
        width: 100%;
        height: 90%;
        padding: 10px;
        margin-bottom: 10px;
    }.total-user{
        font-size: 2rem;
    }
    .item-div,.todays-div,.graph-div,.calendar-div,.notes-div{
        background-color: #0D0A0B;
        color: #F3EFF5;
        text-align: center;
        padding: 10px;
        border-radius: 10px;
        font-size: 20px;
        font-weight: bold;
    }@media (max-width: 768px) {
        .dashboard-container{
            display: grid;
            grid-template-columns:repeat(2, 1fr);
            grid-template-rows: repeat(8, 1fr);
        }.admin-div{
            grid-column: 1/span 2;
        }.todays-div{
            grid-row: 2/span 2;
        }.graph-div{
            grid-column: 1/span 2;
            grid-row: 5/span 1;
        }.calendar-div{
            grid-column: 1/span 2;
            
        }.notes-div{
            grid-column: 1/span 2;
        }.today-item{
            width: 80%;
            height: 80%;    
        }.total-user{
        font-size: 1rem;
    }
    }
</style>
<body>
<h1 class="label-dashboard" >Dashboard</h1>
    <div class="dashboard-container">
        <div class="admin-div">
        <div class="greeting">
            <p style="color:#72B01D;font-size: 14px" >Good day,</p>
            <h2 style="font-size: 24px">Gabriel Manialong</h2>
            <!-- Time and Date -->
            <div class="datetime">
                <p id="time">11:37 AM</p>
                <p id="date">8/26/2024</p>
            </div>
        </div>

        </div>
        <div class="item-div">
        <p class="label-totaluser" >Total Users</p>
        <p class="total-user "><?php echo $totalnumber; ?></p>
        </div>
        <div class="item-div">
        <p class="label-totaluser" >Students</p>
        <p class="total-user" ><?php echo $totalstudents; ?></p>   
        </div>
        <div class="item-div">
        <p class="label-totaluser" >Applicants</p>
        <p class="total-user" ><?php echo $totalapplicants; ?></p>
        </div>
        <div class="item-div">
        <p class="label-totaluser" >Instructors</p>
        <p class="total-user" ><?php echo $totalprofessor; ?></p>
        </div>
        <div class="todays-div">Todays
            <div class="today-item">
                <p style="font-size: 14px;font-weight: bold" >Application sent:</p>
            <i class='bx bx-group box-icon'></i>
                <?php echo $totalapplicants;?>

            </div>
            
            <div class="today-item">
            <p style="font-size: 14px;font-weight: bold" >Reported Videos</p>
            <i class='bx bx-flag box-icon'></i>

                <?php echo $totalvideoreport;?>

            </div>
        </div>
        <div class="graph-div">
        <h3 style="font-size: 20px;font-weight: bold;`" >Graphs</h3>
        <div id="chart"></div>



        </div>
        <div class="calendar-div" id="calendar"></div>
        <div class="notes-div">
        <div class="note-container">
            <h3 style="font-size: 20px;font-weight: bold;`" >Notes</h3>
            <button class="add-notes" id="add-notes"><i class="fas fa-plus box-icon"></i></button>
            <div class="notes-item-container" id="notes-item" onclick="loadNotes()">
                <!-- New notes will be appended here -->
            </div>
            
        </div>
        


    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Shows a monthly view by default
            selectable: true, // Allows date selection
            editable: true, // Enables event dragging and resizing
            events: [
                {
                    title: 'Event 1',
                    start: '2024-09-01', // Start date of the event
                },
                {
                    title: 'Event 2',
                    start: '2024-09-10',
                    end: '2024-09-12' // End date of the event
                }
            ]
        });
        
        calendar.render(); // Renders the calendar
    });

    function updateDateTime() {
        const now = new Date();

        // Format the time
        let hours = now.getHours();
        let minutes = now.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // If hour is 0, display as 12
        minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero to minutes

        const timeString = hours + ':' + minutes + ' ' + ampm;

        // Format the date
        const day = now.getDate();
        const month = now.getMonth() + 1; // Months are zero-based
        const year = now.getFullYear();
        const dateString = month + '/' + day + '/' + year;

        // Update the HTML elements
        document.getElementById('time').textContent = timeString;
        document.getElementById('date').textContent = dateString;
    }

    // Update the time and date once at the beginning
    updateDateTime();

    // Update the time every second
    setInterval(updateDateTime, 1000);

    // Function to load and display notes
    function loadNotes() {
    fetch('Ajax/display_notes.php')
        .then(response => response.json())
        .then(notes => {
            const notesContainer = document.getElementById('notes-item');
            notesContainer.innerHTML = ''; // Clear existing notes

            notes.forEach(note => {
                const noteDiv = document.createElement('div');
                noteDiv.className = 'notes-item';
                noteDiv.dataset.id = note.id; // Store note ID in a data attribute
                noteDiv.innerHTML = `
                    <span>${note.content}</span>
                    <button class="delete-note" style="border: none;" data-id="${note.id}"><i class="fas fa-trash box-icon" style="color: #C75F5F;" ></i></button>
                `;
                notesContainer.appendChild(noteDiv);
            });

            // Add event listeners for delete button
            document.querySelectorAll('.delete-note').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent the click event from bubbling up

                    const id = this.dataset.id;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to recover this note!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('Ajax/delete_notes.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `id=${id}`
                            }).then(response => response.text())
                              .then(message => {
                                  Swal.fire(message);
                                  loadNotes(); // Reload notes after deletion
                              });
                        }
                    });
                });
            });

            // Add event listeners for note click
            document.querySelectorAll('.notes-item').forEach(noteDiv => {
                noteDiv.addEventListener('click', function() {
                    const id = this.dataset.id;
                    fetch(`Ajax/get_notes.php?id=${id}`)
                        .then(response => response.json())
                        .then(note => {
                            Swal.fire({
                                title: 'View/Edit Note',
                                text: note.content,
                                input: 'text',
                                inputValue: note.content,
                                showCancelButton: true,
                                confirmButtonText: 'Save Changes',
                                cancelButtonText: 'Close',
                                inputValidator: (value) => {
                                    if (!value) {
                                        return 'You need to write something!';
                                    }
                                }
                            }).then((result) => {
                                if (result.isConfirmed && result.value) {
                                    fetch('Ajax/edit_notes.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: `id=${id}&content=${encodeURIComponent(result.value)}`
                                    }).then(response => response.text())
                                      .then(message => {
                                          Swal.fire(message);
                                          loadNotes(); // Reload notes after edit
                                      });
                                }
                            });
                        });
                });
            });
        });
}


    document.addEventListener('DOMContentLoaded', function() {
        loadNotes(); // Load notes when the page loads

        document.getElementById('add-notes').addEventListener('click', function() {
            Swal.fire({
                title: 'Enter your note',
                input: 'text',
                inputLabel: 'Your note',
                inputPlaceholder: 'Type your note here',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to write something!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    fetch('Ajax/save_notes.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `noteContent=${encodeURIComponent(result.value)}`
                    }).then(response => response.text())
                      .then(message => {
                          Swal.fire(message);
                          loadNotes(); // Reload notes after saving
                      });
                }
            });
        });
    });
    var options = {
          series: [{
          name: 'Inflation',
          data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: 'Monthly Inflation in Argentina, 2002',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      

</script>



</html>