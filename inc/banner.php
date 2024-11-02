<div class="card">
    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
        <h6 class="mb-0 fw-bold ">Manage Banner</h6>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- OrderHistorytab End -->
            <div class="tab-pane fade show active" id="TradeHistory">
                <div class="card bg-transparent shadow-none">
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#saveBanner">Add Banner</button>
                        <div class="my-3 border-top">

                        </div>

                        <div class="row row-cols-1 row-cols-lg-3 justify-content-center g-lg-5">

                            <?php

                            include "controller/controllerGuest.php";
                            $main = new controllerGuest();

                            $hasil = $main->getDataBanner();
                            foreach ($hasil as $data) {
                                $id = $data["id"];
                                $name = $data["name"];
                                $link = $data["link"];
                                $image = $data["image"];

                                echo "
                                <div class=\"col\">
                                    <div class=\"card\">
                                    <center><h3 class=\"mb-0 text-uppercase\">" . $name . "</h3></center>
                                        <img src=\"" . $image . "\" class=\"card-img-top\" alt=\"...\">
                                        <div class=\"card-body\">
                                        <td>
                                            <button type=\"button\" class=\"btn btn-sm btn-outline-primary\" data-bs-toggle=\"modal\"
                                                       class=\"bi bi-pencil-fill\" data-bs-target=\"#editDataBanner" . $id . "\"></i>Edit Banner</button>
                                            <button type=\"button\" class=\"btn btn-danger\" data-bs-toggle=\"modal\"
                                                       >Delete</button>
                                        </div>
                                    </div>
                                </div>
                            ";
                                echo "
                                <!-- Modal Edit -->
                                <div class=\"modal fade\" id=\"editDataBanner" . $id . "\" tabindex=\"-1\" aria-hidden=\"true\">
                                    <div class=\"modal-dialog modal-lg modal-dialog-centered\">
                                        <div class=\"modal-content bg-dark\">
                                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                <div class=\"modal-header\">
                                                    <h5 class=\"modal-title text-white\">Edit Data Banner</h5>
                                                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                </div>
                                                <div class=\"modal-body text-white\">
                                                    <div class=\"modal-body text-white\">
                                                        <input type=\"hidden\" name=\"id\" value = \"$id\" class=\"form-control\" required/>
                                                        <div class=\"col-12\">
                                                            <label class=\"form-label\">Name</label>
                                                            <input type=\"text\" name=\"name\" class=\"form-control\" id=\"item100\" value=\"" . $name . "\"> 
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <label class=\"form-label\">Link</label>
                                                            <input type=\"text\" name=\"link\" class=\"form-control\" id=\"item100\" value=\"" . $link . "\"> 
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <label class=\"form-file\">Images</label>
                                                            <img id=\"frame" . $id . "\" src=\"$image\" class=\"img-fluid\" />
                                                            <input type=\"file\" name=\"image\" value=\"$image\" class=\"form-control\" id=\"formFileMultiple" . $id . "\" onchange=\"preview('" . $id . "')\">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"modal-footer\">
                                                <!-- <button type=\"button\" id=\"buttonClear" . $id . "\" onclick=\"clearImage('" . $id . "','" . $image . "')\" class=\"btn btn-light\">Clear</button> -->
                                                    <button type=\"button\" class=\"btn btn-light\" data-bs-dismiss=\"modal\">Close</button>
                                                    <button type=\"submit\" name=\"editDataBanner\" class=\"btn btn-dark\">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            ";
                                echo "
                                <!-- Modal Add Banner -->
                                <div class=\"modal fade\" id=\"saveBanner\" tabindex=\"-1\" aria-hidden=\"true\">
                                    <div class=\"modal-dialog modal-lg modal-dialog-centered\">
                                        <div class=\"modal-content bg-dark\">
                                            <form action=\"save.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                <div class=\"modal-header\">
                                                    <h5 class=\"modal-title text-white\">Add Banner</h5>
                                                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                </div>
                                                <div class=\"modal-body text-white\">
                                                    <div class=\"modal-body text-white\">
                                                        <div class=\"col-12\">
                                                            <label class=\"form-label\">Name</label>
                                                            <input type=\"text\" name=\"name\" class=\"form-control\" id=\"item100\" required> 
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <label class=\"form-label\">Link</label>
                                                            <input type=\"text\" name=\"link\" class=\"form-control\" id=\"item100\" required> 
                                                        </div>
                                                        <div class=\"col-12\">
                                                            <label for=\"formFileMultiple\" class=\"form-label\">Images</label>
                                                            <img id=\"frame\" src=\"\" class=\"img-fluid\" />
                                                            <input id =\"formFileMultiple\" type=\"file\" name=\"image\" class=\"form-control\" onchange=\"preview('')\" required>
                                                        </div>
                                                    </div>
                                                    <input type=\"hidden\" name=\"id\"  class=\"form-control\" required placeholder=\"\" />
                                                    
                                                </div>
                                                <div class=\"modal-footer\">
                                                    <button type=\"button\" class=\"btn btn-light\"
                                                        data-bs-dismiss=\"modal\">Close</button>
                                                    <button type=\"submit\" name=\"saveBanner\" class=\"btn btn-dark\">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            ";
                            }
                            ?>
                            </tbody>
                            <!-- </table> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- 
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
            </div> -->
        </div>

    </div>
</div>
</div>
<script>
    // function checkModal(id) {

    // }

    // function formSubmit(id) {
    //     document.getElementById("formEditEvent" + id).submit();
    // }
    // function formSubmit2(id) {
    //     document.getElementById("formAddTicket" + id).submit();
    // }


    // function checkCategory() {
    //     var nameCategory = document.getElementById("categoryCheck").value;
    //     var nameCategory2 = document.getElementById("categoryCheck" + nameCategory);
    //     let name = nameCategory2.getAttribute("data");

    //     console.log(name);
    //     if (name == "Competition Event") {
    //         document.getElementById("typeComp").style.display = "block";
    //         document.getElementById("mxPly").style.display = "block";
    //     } else {
    //         document.getElementById("typeComp").style.display = "none";
    //         // $('#form').append('<input type="hidden" name="type" value="" />');
    //         document.getElementById("mxPly").style.display = "none";
    //     }
    // }

    function preview(id) {
        var banner = document.getElementById("frame" + id);
        banner.src = URL.createObjectURL(event.target.files[0]);
    }

    function clearImage(id, banner3) {
        var banner2 = document.getElementById("frame" + id);
        document.getElementById("image" + id).value = null;
        banner2.src = banner3;
    }
</script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script> -->