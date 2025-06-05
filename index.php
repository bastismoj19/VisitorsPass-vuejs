<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bulma.css">
    <script src="vue.js"></script>
    <script src="jquery.js"></script>
    <script src="genericajax.js"></script>
    <style>
        .pass-container {
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: rgb(240, 240, 240);
        }

        .section-header {
            font-weight: bold;
            border-bottom: 1px solid black;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .section-bottom  {
            font-weight: bold;
            border-top: 1px solid black;
            padding-top: 10px;
            margin-bottom: 1.5rem;
        }

        .field {
            margin-bottom: 10px;
        }
        
        .is-flex {
            justify-content: space-between;
        }

        .purpose {
            display: flex;
            justify-content: center;
        }

        .n-modal-window {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: auto;
            display: none;
        }

        .closeBtn, .submitBtn, .logoutBtn, .addBtn, .approveBtn, .saveData {
            margin-left: 92%;
        }
        
    </style>
</head>
<body>
    <div id="VisitorPassAppContainer">  
        <section class="box">  
            <button class="button is-success is-small entryBtn" @click="ShowNewForm"> New entry</button>    
            <div>
                <div class="section-header">
                    <h2 class="title is-3 mt-5 ml-5">VISITOR PASS</h2>
                </div>
                <table class="table is-fullwidth mt-5 tblDataList">
                    <tr>
                        <th>Date of Visit</th>
                        <th>Name of Visitor/s</th>
                        <th>Time</th>
                        <th>Requested by</th>
                        <th>Status</th>
                        <th>Visitor's Pass</th>
                    </tr>
                    <tr v-for="item in ListOfItems">
                        <td>{{ item.dateOfVisit}}</td>
                        <td>{{ item.nameOfVisitor }}</td>
                        <td>{{ item.timeOfVisit }}</td>
                        <td>{{ item.requestedBy }}</td>
                        <td>{{ item.status }}</td>
                        <td>{{ item.vpassNo }}</td>
                        <td><input type="button" class="button is-small is-danger" @click="DeleteDataFromDB" value="Delete"></td>
                    </tr>
                </table>     
            </div>
        </section>

        <section class="section n-modal-window">
            <div class="container">
                <div class="box pass-container">
                    <!-- Header -->
                    <div class="section-header">
                        <button class="button closeBtn is-danger" @click="CloseNewForm">Close</button>
                        <h2 style="margin-top: -2.3rem;" class="title is-3">Visitor’s Pass</h2>
                    </div>
                    
                    <!-- First Row -->
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Visitor Pass Number:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.vpassNo" placeholder="Pass Number">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Date:</label>
                                <input class="input " v-model="this.DataFromNewForm.date" type="date">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Status:</label>
                                <div class="select">
                                    <select class="" v-model="this.DataFromNewForm.status">
                                        <option value="">Open</option>
                                        <option value="Submitted to Dept Manager">Submit to Dept Manager</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Requested by:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.requestedBy" placeholder="Requested by">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Department Manager:</label>
                                <div class="select">
                                    <select class="" v-model="this.DataFromNewForm.deptMgr">
                                        <option value="">Select</option>
                                        <option value="wjbastismo">Walter James</option>
                                        <option value="mpresillas">Mary Grace</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <!-- Visitor’s Information -->  
                    <div class="section-bottom">
                        <button class="button addBtn is-success">Add</button>
                        <h3 style="margin-top: -2.3rem;" class="title is-5">Visitor's Information</h3>   
                    </div>

                    <div class="columns visitorInfo">
                        <div class="column">
                            <div class="field">
                                <label class="label">Name:</label>
                                <textarea class="input " type="text" v-model="this.DataFromNewForm.nameOfVisitor" placeholder="Name"></textarea>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Position:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.position" placeholder="Position">
                            </div>
                        </div>
                    </div>

                    <div class="columns">  
                        <div class="column">
                            <div class="field">
                                <label class="label">Company:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.company" placeholder="Company">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Address:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.address" placeholder="Address">
                            </div>
                        </div>
                    </div>

                    <div class="addVisitor">

                    </div>

                    <!---Permissions---> 
                    <div class="section-bottom">
                        <h3 class="title is-5">Company Permissions</h3>   
                    </div>

                    <div class="columns purpose">
                        <div class="column is-one-quarter">
                            <div class="field">
                                <label class="label">Purpose of Visit:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.purposeOfVisit" placeholder="Purpose">
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Parking inside FCI?</label>
                                <div class="select">
                                    <select class="" v-model="this.DataFromNewForm.parkingInsideFCI">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>                          
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Allow Camera/Cell with Camera?</label>
                                <div class="select">
                                    <select class="" v-model="this.DataFromNewForm.allowCam">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>  
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Camera Justification:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.camJustification" placeholder="Justification">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Areas to be Photographed:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.areasToPic" placeholder="Areas">
                            </div>
                        </div>
                    </div>

                    <!-- Person to be Visited -->
                    <div class="section-bottom">
                        <h3 class="title is-5">Visit Details</h3>   
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Person to be Visited:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.personsToBeVisited" placeholder="Person's Name">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Area to be Visited:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.areaToBeVisited" placeholder="Area">
                            </div>
                        </div>
                    </div>

                    <!-- Visit Details -->
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Date of Visit:</label>
                                <input class="input " v-model="this.DataFromNewForm.dateOfVisit" type="date">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Duration of Visit (day):</label>
                                <input class="input " v-model="this.DataFromNewForm.durationOfDayVisit" type="text">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Time of Visit:</label>
                                <input class="input " v-model="this.DataFromNewForm.timeOfVisit" type="time">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Escort of the Visitor:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.escort" placeholder="Escort Name">
                            </div>
                        </div>                            
                    </div>

                    <!--- FOR SECURITY --->
                    <div style="display: none;" class="securityAss columns section-bottom">
                        <div class="column">
                            <div class="field">
                                <label class="label">Actual Date in:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.actualDateIn" placeholder="Date in">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Actual Time-in:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.timeIn" placeholder="Time-in">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Actual Time-out:</label>
                                <input class="input " type="text" v-model="this.DataFromNewForm.actualTimeOut" placeholder="Time-out">
                            </div>
                        </div>                         
                    </div>
                    <button class="button is-success submitBtn" @click="SaveDataToDB">Submit</button>
                </div>
            </div>
        </section>          
    </div>

    <script>

        const { createApp } = Vue;

        var my_application_data = {            
            ListOfItems: [],

            DataFromNewForm: {
                vpassNo: "",
                vpassNo: "",
                requestedBy: "",
                date: "",
                deptMgr: "",
                status: "",
                nameOfVisitor: "",
                company: "",
                position: "",
                address: "",
                purposeOfVisit: "",
                parkingInsideFCI: "",
                allowCam: "",
                camJustification: "",
                areasToPic: "",
                personsToBeVisited: "",
                areaToBeVisited: "",
                dateOfVisit: "",
                timeOfVisit: "",
                durationOfDayVisit: "",
                escort: "",
                actualDateIn: "",
                timeIn: "",
                actualTimeOut: "",
            },            
        };

        var my_application_functions = {
            
            //DISPLAY DATA
            LoadListOfDataFromDB: function(){
                let SELF = this;
                GenericAjax("display_info.php", {}, function(result_from_page){
                    SELF.ListOfItems = result_from_page;
                    
                });
            }, 
            
            // save data to database
            SaveDataToDB: function(){
                let SELF = this;
                
                GenericAjax("save_Data_To_DB.php", this.DataFromNewForm, function(result_from_page){
                    alert("data successfully saved.");

                    //SENDING OF EMAIL NOT WORKING
                        GenericAjax("../phpMailer.php", this.DataFromNewForm, function(result_from_page){
                            console.log(result_from_page);
                        });

                        setTimeout(function() {
                            alert("Data sent to Department Manager!");                                    
                            location.reload();  
                        }, 2000); 
                });
            },
            
            ShowNewForm: function(){
                $(".section").show('fast');
            },

            CloseNewForm: function(){
                $(".section").hide('fast');
            },
        }

        var options = {
            mounted: function(){
                // auto execute code/s below
                this.LoadListOfDataFromDB();
            },
            data: function(){ return my_application_data; },
            methods: my_application_functions,   
        };

        // Mount the Vue application
        createApp(options).mount('#VisitorPassAppContainer');
    </script>
</body>
</html>