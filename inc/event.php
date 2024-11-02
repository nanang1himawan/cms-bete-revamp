<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-column-gap: 10px;
        grid-row-gap: 10px;
    }

    .child {
        height: fit-content;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 480px) {
        .card {
            margin-bottom: 5px;
        }
    }
</style>

<div class="card">
    <div class="card-header py-3 border-bottom">
        <h2 class="mb-0 fw-bold text-center">Event List</h2>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- OrderHistorytab End -->
            <div class="tab-pane fade show active">
                <!-- <tbody> -->
                <div class="card bg-transparent shadow-none border-0">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-lg-3 justify-content-center g-lg-5">
                            <?php
                            include "controller/controllerGuest.php";
                            $main = new controllerGuest();
                            $idGuest = $_SESSION['id_user'];
                            if ($_SESSION['status'] == 'BETE') {
                                $hasil = $main->getDataEvent();
                            } else {
                                $hasil = $main->getDataEventByCreateBy($idGuest);
                            }

                            foreach ($hasil as $data) {
                                $id = $data["id"];
                                $name = $data["name"];
                                $category = $data["id_event_category"];
                                $type = $data["type"];
                                $maxPlayer = $data["max_player"];
                                $description = $data["description"];
                                $termCondition = $data["term_and_condition"];
                                $venue = $data["venue"];
                                $location = $data["location"];
                                $poster = $data["image"]; //wew
                                $startDate = $data["start_date"];
                                $endDate = $data["end_date"];
                                $status = $data["status"];
                                $maps = $data["maps"];
                                $create_by = $data["create_by"];

                                echo "
                                <div class=\"col\">
                                    <div class=\"card border border-3\">
                                        <div class=\"card-body\">    
                                            <center><h3 class=\"text-uppercase card-title\">" . $name . "</h3></center>
                                            <img src=\"" . $poster . "\" class=\"card-img-top\" alt=\"...\">
                                            <form id=\"formEditEvent" . $id . "\" name=\"formEditEvent\"  method=\"GET\">
                                            <input type=\"hidden\" name=\"event\" value=\"$id\"/>
                                            </form>
                                            <form action=\"addTicket.php\" id=\"formAddTicket" . $id . "\" name=\"formAddTicket\"  method=\"GET\">
                                            <input type=\"hidden\" name=\"event\" value=\"$id\"/>
                                            </form>
                                            <form action=\"qr-code.php\" id=\"formShowQR" . $id . "\" name=\"formShowQR\"  method=\"GET\">
                                            <input type=\"hidden\" name=\"event\" value=\"$id\"/>
                                            </form>
                                            <div class=\"py-2 parent\">";

                                if ($_SESSION['status'] == 'BETE') {
                                    echo "
                                                <div type=\"button\" onclick=\"formSubmit2('" . $id . "')\" class=\"btn btn-sm btn-outline-primary child\">Add Ticket</div>    
                                                <div type=\"button\" onclick=\"formSubmit('" . $id . "')\" class=\"btn btn-sm btn-outline-primary child\">Edit Event</div>
                                    ";
                                }

                                echo "
                                                <div type=\"button\" onclick=\"checkModal('" . $id . "')\" class=\"btn btn-sm btn-outline-primary child\" data-bs-toggle=\"modal\" data-bs-target=\"#editFoto" . $id . "\">Edit Poster</div>
                                                <div type=\"button\" onclick=\"checkModal('" . $id . "')\" class=\"btn btn-sm btn-outline-primary child\" data-bs-toggle=\"modal\" data-bs-target=\"#updateStatus" . $id . "\">Update Status</div>
                                ";

                                if ($type == 'Private') {
                                    echo "
                                                <div type=\"button\" onclick=\"formSubmit2('" . $id . "')\" class=\"btn btn-sm btn-outline-primary child\">Add Ticket</div>    
                                                <div type=\"button\" onclick=\"formSubmit('" . $id . "')\" class=\"btn btn-sm btn-outline-primary child\">Edit Event</div>
                                                <div type=\"button\" onclick=\"formSubmit3('" . $id . "')\" class=\"btn btn-sm btn-outline-primary child\">Show QR Code</div>
                                    ";
                                } else {

                                }

                                echo "               
                                                <div type=\"button\" class=\"btn btn-sm btn-danger text-white child\" data-bs-toggle=\"modal\">Delete Event</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";

                                echo "
                                <!-- Modal Edit Poster-->
                                <div class=\"modal fade\" id=\"editFoto" . $id . "\" tabindex=\"-1\" aria-hidden=\"true\">
                                    <div class=\"modal-dialog modal-lg modal-dialog-centered\">
                                        <div class=\"modal-content bg-dark\">
                                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                <div class=\"modal-header\">
                                                    <h5 class=\"modal-title text-white\">Edit Poster</h5>
                                                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                </div>
                                                <div class=\"modal-body text-white\">
                                                    <div class=\"modal-body text-white\">
                                                        <div class=\"col-12\">
                                                            <label class=\"form-label\">Images</label>
                                                            <img id=\"frame" . $id . "\" src=\"$poster\" class=\"img-fluid\" />
                                                            <input type=\"file\" name=\"poster\" value=\"$poster\" class=\"form-control\" id=\"images" . $id . "\" onchange=\"preview('" . $id . "')\" required>
                                                        </div>
                                                    </div>
                                                    <input type=\"hidden\" name=\"id\" value = \"$id\" class=\"form-control\" required placeholder=\"\" />
                                                    
                                                </div>
                                                <div class=\"modal-footer\">
                                                <button type=\"button\" id=\"buttonClear" . $id . "\" onclick=\"clearImage('" . $id . "','" . $poster . "')\" class=\"btn btn-light\">Clear</button>
                                                    <button type=\"button\" class=\"btn btn-light\"
                                                        data-bs-dismiss=\"modal\">Close</button>
                                                    <button type=\"submit\" name=\"editFoto\" class=\"btn btn-dark\">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                ";

                                echo "
                                <!-- Modal Update Status Event-->
                                <div class=\"modal fade\" id=\"updateStatus" . $id . "\" tabindex=\"-1\" aria-hidden=\"true\">
                                    <div class=\"modal-dialog modal-lg modal-dialog-centered\">
                                        <div class=\"modal-content bg-dark\">
                                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                <div class=\"modal-header\">
                                                    <h5 class=\"modal-title text-white\">Update Status Event</h5>
                                                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                </div>
                                                <div class=\"modal-body text-white\">
                                                    <div class=\"modal-body text-white\">
                                                        <div class=\"col-12\">
                                                            <label class=\"form-label\">Status Event</label>
                                                            <select class=\"form-select\" id=\"selectedStatus\" name=\"selectedStatus\">
                                                                <option selected disable>" . $status . "</option>
                                                                <option value=\"Open\">open</option>
                                                                <option value=\"Upcoming\">upcoming</option>
                                                                <option value=\"Close\">close</option>
                                                            </select>                                                      
                                                        </div>
                                                    </div>
                                                    <input type=\"hidden\" name=\"id\" value = \"$id\" class=\"form-control\" required placeholder=\"\" />
                                                </div>
                                                <div class=\"modal-footer\">
                                                    <button type=\"button\" class=\"btn btn-light\"
                                                        data-bs-dismiss=\"modal\">Close</button>
                                                    <button type=\"submit\" name=\"updateStatusEvent\" class=\"btn btn-dark\">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                            ?>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <h5 class="modal-title w-100" id="exampleModalLabel">
                            Payment Receipt
                        </h5>
                    </div>
                    <div class="modal-body">
                        <img src="assets/images/coin/SOL.png" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">
                            Verify
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
    function checkModal(id) {

    }

    function formSubmit(id) {
        document.getElementById("formEditEvent" + id).submit();
    }

    function formSubmit2(id) {
        document.getElementById("formAddTicket" + id).submit();
    }

    function formSubmit3(id) {
        document.getElementById("formShowQR" + id).submit();
    }


    function checkCategory() {
        var nameCategory = document.getElementById("categoryCheck").value;
        var nameCategory2 = document.getElementById("categoryCheck" + nameCategory);
        let name = nameCategory2.getAttribute("data");

        console.log(name);
        if (name == "Competition Event") {
            document.getElementById("typeComp").style.display = "block";
            document.getElementById("mxPly").style.display = "block";
        } else {
            document.getElementById("typeComp").style.display = "none";
            // $('#form').append('<input type="hidden" name="type" value="" />');
            document.getElementById("mxPly").style.display = "none";
        }
    }

    function preview(id) {
        var poster = document.getElementById("frame" + id);
        poster.src = URL.createObjectURL(event.target.files[0]);
    }

    function clearImage(id, poster3) {
        var poster2 = document.getElementById("frame" + id);
        document.getElementById("images" + id).value = null;
        poster2.src = poster3;
    }
</script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script> -->