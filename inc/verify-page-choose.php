<div class="card">
    <div class="card-header py-3 d-flex align-items-center bg-transparent border-bottom-0">
        <h6 class="mb-0 fw-bold ">Choose Event</h6>
    </div>
    <?php

    include "controller/controllerGuest.php";
    $main = new controllerGuest();
    $idGuest = $_SESSION['id_user'];


    if ($_SESSION['status'] == "BETE") {
        $hasil = $main->getDataEvent();
    } else {
        $hasil = $main->getDataEventbyCreateBy($idGuest);
    }

    ?>
    <div class="card-body">
        <div class="tab-content">
            <!-- OrderHistorytab End -->
            <div class="col-md-8">
                <select  onchange="setIdEvent(this)" name="eventName" id="eventSelected" class="form-select">
                    <option  selected disabled value="">Choose Event...</option>
                    <?php

                    foreach ($hasil as $data2) {
                        $id2 = $data2["id"];
                        $name2 = $data2["name"];
                        // $getTicketData = $main->getDataTicketCategoryByEventId($id2);
                        echo "
                           <option  data=\"" . $name2 . "\"value=\"" . $id2 . "\">" . $name2 . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <script>
        function setIdEvent(id) {
            var idEvent = id.value;
            window.location.href = 'verify-orders?event='+idEvent;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>