<div class="card">
    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
        <h6 class="mb-0 fw-bold ">Edit Event</h6>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- OrderHistorytab End -->
            <div class="tab-pane fade show active" id="TradeHistory">
                <table id="ordertabthree"
                    class="priceTable table table-hover custom-table-2 table-bordered align-middle mb-0"
                    style="width:100%">
                    <tbody>

                        <?php
                        include "controller/controllerGuest.php";
                        $main = new controllerGuest();
                        $id = $_GET["event"];
                        $hasil = $main->getDataEventById($id);
                        foreach ($hasil as $data) {
                            $id = $data["id"];
                            $name = $data["name"];
                            $category = $data["id_event_category"];
                            $type = $data["type"];
                            $maxPlayer = $data["max_player"];
                            $minPlayer = $data["min_player"];
                            $description = $data["description"];
                            $termCondition = $data["term_and_condition"];
                            $venue = $data["venue"];
                            $location = $data["location"];
                            $banner = $data["image"]; //wew
                            $startDate = $data["start_date"];
                            $endDate = $data["end_date"];
                            $maps = $data["maps"];
                            $create_by = $data["create_by"];
                            $idForm = $data["id_form"];

                            echo "
                            
                            
                                
                                        
                                        <div class=\"deadline-form\">
                                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                <input type=\"hidden\" name=\"id\" value=\"" . $id . "\">
                                                <input type=\"hidden\" name=\"create_by\" value=\"" . $create_by . "\">
                                                <input name=\"type\" type=\"hidden\" value=\"\">
                                                <input name=\"maxPlayer\" type=\"hidden\" value=\"\">
                                                <input name=\"minPlayer\" type=\"hidden\" value=\"\">
                                                <input name=\"formSelect\" type=\"hidden\" value=\"\">
                                                
                                                    <div class=\"col-sm-12\">
                                                    <label for=\"item100\" class=\"form-label\">Name</label>
                                                    <input type=\"text\" name=\"name\" class=\"form-control\" id=\"item100\" value=\"" . $name . "\"> 
                                                    </div>
                                                    

                                                    <div class=\"col-md-6\">
                                                    <label for=\"validationCustom04\" class=\"form-label\">Category Event</label>
                                                    <select name=\"category\" class=\"form-select\" onchange=\"checkCategory()\" id=\"categoryCheck\" required>";

                            $hasil3 = $main->getDataCategoryEventById($category);
                            foreach ($hasil3 as $data) {
                                $id3 = $data["id"];
                                $name3 = $data["name"];

                                echo "
                                                        <option id=\"selected\" selected value=\"" . $id3 . "\">" . $name3 . "</option>
                                                        ";
                            }

                            $hasil2 = $main->getDataCategoryEvent();
                            foreach ($hasil2 as $data) {
                                $id2 = $data["id"];
                                $name2 = $data["name"];
                                $type2 = $data["type"];
                                if ($_SESSION['status'] == 'ORGANIZER') {
                                    if ($type2 == 'Private') {
                                        echo "
                                                            <option id=\"categoryCheck" . $id2 . "\" data=\"" . $name2 . "\"value=\"" . $id2 . "\">" . $type2 . " " . $name2 . "</option>
                                                        ";
                                    }
                                } else {
                                    echo "
                                                            <option id=\"categoryCheck" . $id2 . "\" data=\"" . $name2 . "\"value=\"" . $id2 . "\">" . $type2 . " " . $name2 . "</option>
                                                        ";
                                }
                                // echo "
                        
                                // <option id=\"categoryCheck" . $id2 . "\" data=\"" . $name2 . "\" value=\"" . $id2 . "\">" . $name2 . "</option>
                        
                                // ";
                            }

                            echo "
                                                    </select>
                                                </div>

                                                <div class=\"col-md-6\" id=\"typeComp\" style=\"display: none;\">
                                                    <label for=\"validationCustom04\" class=\"form-label\">Type Competition</label>
                                                    <select name=\"type\" class=\"form-select\" onchange=\"checkPlayer(this)\" id=\"type2\">
                                                        <option id=\"selected2\" selected >" . $type . "</option>
                                                        <option >Team Player</option>
                                                        <option >Single Player</option>
                                                    </select>
                                                </div>
                                                <div class=\"col-md-4\" id=\"formSelect\" style=\"display: none;\">
                                                    <label for=\"validationCustom04\" class=\"form-label\">Form Event</label>
                                                    <select id=\"formSelect2\" name=\"formSelect\" class=\"form-select\">
                                                        <option selected value=\"" . $idForm . "\">";

                            $hasil5 = $main->getDataFormById($idForm);
                            foreach ($hasil5 as $data5) {
                                $nameForm = $data5["form_name"];
                                echo $nameForm;
                            }

                            echo "</option>
                                                        ";
                            $idGuest = $_SESSION['id_user'];
                            if ($_SESSION['status'] == 'BETE') {
                                $hasil4 = $main->getDataForm();
                            } else {
                                $hasil4 = $main->getDataFormByGuestId($idGuest);
                            }
                            foreach ($hasil4 as $data4) {
                                $id3 = $data4["id"];
                                $name3 = $data4["form_name"];

                                echo "
                                                                    
                                                                <option data=\"" . $name3 . "\"value=\"" . $id3 . "\">" . $name3 . "</option>

                                                            ";
                            }

                            echo "
                                                        ?>

                                                    </select>
                                                </div>
                                                <div class=\"col-md-6\" id=\"mnPly\" style=\"display: none;\">
                                                    <div class=\"form-group\">
                                                        <label class=\"form-label\">Min Player/Team</label>
                                                        <input id=\"minPlayer2\" name=\"minPlayer\" type=\"number\" value=\"" . $minPlayer . "\" class=\"form-control\">
                                                    </div>
                                                </div>
                                                <div class=\"col-md-6\" id=\"mxPly\" style=\"display: none;\">
                                                    <div class=\"form-group\">
                                                        <label class=\"form-label\">Max Player/Team</label>
                                                        <input id=\"maxPlayer2\" name=\"maxPlayer\" type=\"number\" value=\"" . $maxPlayer . "\" class=\"form-control\">
                                                    </div>
                                                </div>
                                                <div class=\"row g-3 mb-3\">
                                                    <div class=\"col-sm-12\">
                                                        <label class=\"form-label\">Description</label>
                                                        <textarea name=\"description\" class=\"form-control\" rows=\"3\">" . $description . "</textarea>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-6\">
                                                    <label for=\"admitdate\" class=\"form-label\">Start Date</label>
                                                    <input name=\"startDate\" type=\"date\" class=\"form-control\" id=\"admitdate\" value=\"" . $startDate . "\" required>
                                                </div>
                                                <div class=\"col-md-6\">
                                                    <label for=\"admitdate\" class=\"form-label\">End Date</label>
                                                    <input name=\"endDate\" type=\"date\" class=\"form-control\" id=\"admitdate\" value=\"" . $endDate . "\" required>
                                                </div>
                                                <div class=\"row g-3 mb-3\">
                                                    <div class=\"col-sm-12\">
                                                        <label class=\"form-label\">Term & Condition</label>
                                                        <textarea name=\"termCondition\" class=\"form-control\" rows=\"3\">" . $termCondition . "</textarea>
                                                    </div>
                                                </div>
                                                <div class=\"col-sm-12\">
                                                    <label for=\"item100\" class=\"form-label\">Venue</label>
                                                    <input type=\"text\" name=\"venue\" class=\"form-control\" id=\"item100\" value=\"" . $venue . "\"> 
                                                </div>
                                                <div class=\"row g-3 mb-3\">
                                                    <div class=\"col-sm-12\">
                                                        <label class=\"form-label\">Location</label>
                                                        <textarea name=\"location\" class=\"form-control\" rows=\"3\">" . $location . "</textarea>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-12\">
                                                    <div class=\"form-group\">
                                                        <label class=\"form-label\">Maps(link embed)</label>
                                                        <textarea name=\"maps\" class=\"form-control\" rows=\"5\" cols=\"30\" required>" . $maps . "</textarea>
                                                    </div>
                                                </div>
                                                <center>
                                                <a href=\"manageEvent.php\"><button type=\"button\" class=\"btn btn-secondary\">Cancel</button></a>
                                                <button type=\"submit\" name=\"editEvent\" class=\"btn btn-primary\">Save</button>
                                                </center>
                                            </form>
                                    </div>
                            
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</div>
<script>

    var xx = document.getElementById("selected").text;
    if (xx == "Competition") {
        document.getElementById("typeComp").style.display = "block";
        document.getElementById("mxPly").style.display = "block";
        document.getElementById("formSelect").style.display = "block";
    } else {
        document.getElementById("typeComp").style.display = "none";
        document.getElementById("mxPly").style.display = "none";
        document.getElementById("formSelect").style.display = "none";
    }

    var xx1 = document.getElementById("selected2").text;
    if (xx1 == "Team Player") {
        document.getElementById("mxPly").style.display = "block";
        document.getElementById("mnPly").style.display = "block";
    } else {
        document.getElementById("mxPly").style.display = "none";
        document.getElementById("mnPly").style.display = "none";
    }

    function checkPlayer(selectObject) {
        var name = selectObject.value;
        if (name == "Team Player") {
            document.getElementById("mxPly").style.display = "block";
            document.getElementById("mnPly").style.display = "block";
        } if (name == "Single Player") {
            document.getElementById("mxPly").style.display = "none";
            document.getElementById("mnPly").style.display = "none";
            document.getElementById("minPlayer2").value = "";
            document.getElementById("maxPlayer2").value = "";
        }
    }

    function checkCategory() {
        var nameCategory = document.getElementById("categoryCheck").value;
        var nameCategory2 = document.getElementById("categoryCheck" + nameCategory);
        let name = nameCategory2.getAttribute("data");

        if (name == "Competition") {
            document.getElementById("typeComp").style.display = "block";
            document.getElementById("mxPly").style.display = "block";
            document.getElementById("mnPly").style.display = "block";
            document.getElementById("formSelect").style.display = "block";
        } else {
            document.getElementById("typeComp").style.display = "none";
            document.getElementById("mxPly").style.display = "none";
            document.getElementById("mnPly").style.display = "none";
            document.getElementById("formSelect").style.display = "none";
            document.getElementById("type2").value = "";
            document.getElementById("minPlayer2").value = "";
            document.getElementById("maxPlayer2").value = "";
            document.getElementById("formSelect2").value = "";
        }
    }
</script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script> -->