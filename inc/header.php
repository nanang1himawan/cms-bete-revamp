<div class="header">
                <nav class="navbar pt-4 pb-1">
                    <div class="container-xxl">
                        <!-- header rightbar icon -->
                        <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                            
                            <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/profile_av.svg" alt="profile">
                                </a>
                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="assets/images/profile_av.svg" alt="profile">
                                                <div class="flex-fill ms-6">
                                                    <p class="mb-0"><span class="font-weight-bold"><?php echo $_SESSION['status']; ?></span></p>
                                                    <small class=""><?php echo $_SESSION['email']; ?></small>
                                                </div>
                                            </div>
                                            
                                            <div><hr class="dropdown-divider border-dark"></div>
                                        </div>
                                        <div class="list-group m-2 ">
                                            <a href="" class="list-group-item list-group-item-action border-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38" class="me-3">
                                                    <path xmlns="http://www.w3.org/2000/svg"   d="M36.15,38H1.85l0.16-1.14c0.92-6.471,3.33-7.46,6.65-8.83c0.43-0.17,0.87-0.36,1.34-0.561  c0.19-0.08,0.38-0.17,0.58-0.26c1.32-0.61,2.14-1.05,2.64-1.45c0.18,0.48,0.47,1.13,0.93,1.78C15.03,28.78,16.53,30,19,30  c2.47,0,3.97-1.22,4.85-2.46c0.46-0.65,0.75-1.3,0.931-1.78c0.5,0.4,1.319,0.84,2.64,1.45c0.2,0.09,0.39,0.17,0.58,0.26  c0.47,0.2,0.91,0.391,1.34,0.561c3.32,1.37,5.73,2.359,6.65,8.83L36.15,38z M20,13v4h-2v-4H20z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                                    <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M21.67,17.34C21.22,18.27,20.29,19,19,19s-2.22-0.73-2.67-1.66l-1.79,0.891C15.31,19.78,16.88,21,19,21  s3.69-1.22,4.46-2.77L21.67,17.34z M15,10.85c-0.61,0-1.1,0.38-1.1,1.65s0.49,1.65,1.1,1.65s1.1-0.38,1.1-1.65S15.61,10.85,15,10.85  z M23,10.85c-0.61,0-1.1,0.38-1.1,1.65s0.489,1.65,1.1,1.65s1.1-0.38,1.1-1.65S23.61,10.85,23,10.85z M35.99,36.86  c-0.92-6.471-3.33-7.46-6.65-8.83c-0.43-0.17-0.87-0.36-1.34-0.561c-0.19-0.09-0.38-0.17-0.58-0.26c-1.32-0.61-2.14-1.05-2.64-1.45  c-0.521-0.42-0.7-0.8-0.761-1.29C26.55,22.74,28,19.8,28,17V4.56l-1.18,0.21C26.1,4.91,25.58,5,25.05,5  c-1.439,0-2.37-0.24-3.35-0.49C20.71,4.26,19.68,4,18.21,4c-1.54,0-2.94,0.69-3.83,1.9l1.61,1.18C16.5,6.39,17.31,6,18.21,6  c1.22,0,2.08,0.22,3,0.45C22.22,6.71,23.36,7,25.05,7c0.32,0,0.63-0.02,0.95-0.06V17c0,3.44-2.62,7-7,7s-7-3.56-7-7V6.29  C12.23,5.59,13.61,2,18.21,2c1.61,0,2.76,0.28,3.88,0.55C23.06,2.78,23.98,3,25.05,3C26.12,3,27.19,2.74,28,2.47V0.34  C27.34,0.61,26.17,1,25.05,1c-0.83,0-1.6-0.18-2.49-0.4C21.38,0.32,20.05,0,18.21,0c-5.24,0-7.64,3.86-8.18,5.89L10,17  c0,2.8,1.45,5.74,3.98,7.47c-0.06,0.49-0.24,0.87-0.76,1.29c-0.5,0.4-1.32,0.84-2.64,1.45c-0.2,0.09-0.39,0.18-0.58,0.26  c-0.47,0.2-0.91,0.391-1.34,0.561c-3.32,1.37-5.73,2.359-6.65,8.83L1.85,38h34.3L35.99,36.86z M4.18,36c0.81-4.3,2.28-4.9,5.24-6.12  c0.62-0.25,1.29-0.53,2-0.86c1.09-0.5,2.01-0.949,2.73-1.479c0.8-0.56,1.36-1.22,1.64-2.12C16.76,25.78,17.83,26,19,26  s2.24-0.22,3.21-0.58c0.28,0.9,0.84,1.561,1.64,2.12c0.721,0.53,1.641,0.979,2.73,1.479c0.71,0.33,1.38,0.61,2,0.86  c2.96,1.22,4.43,1.83,5.24,6.12H4.18z"></path>
                                                </svg>Profile Page
                                            </a>
                                            <!-- <a href="security.html" class="list-group-item list-group-item-action border-0 ">
                                                <svg xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="24px" height="24px" viewBox="0 0 32 32" class="me-3">
                                                    <path xmlns="http://www.w3.org/2000/svg"  d="M15.5,27.482C5.677,24.8,4.625,10.371,4.513,7.497C11.326,7.402,14.5,5.443,15.5,4.661  c0.999,0.782,4.174,2.742,10.986,2.836C26.375,10.371,25.323,24.8,15.5,27.482z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                                    <path xmlns="http://www.w3.org/2000/svg" class="st2" d="M14.13,21.5c-0.801,0-1.553-0.311-2.116-0.873c-0.57-0.57-0.883-1.327-0.881-2.132  c0.001-0.8,0.314-1.55,0.879-2.11c0.555-0.563,1.297-0.876,2.093-0.885c0.131-0.001,0.256-0.054,0.348-0.146l4.63-4.63  c0.388-0.38,0.879-0.583,1.416-0.583s1.028,0.203,1.42,0.587c0.373,0.373,0.58,0.875,0.58,1.413c0,0.531-0.207,1.03-0.584,1.406  l-4.64,4.641c-0.094,0.095-0.146,0.222-0.146,0.354c0,0.782-0.311,1.522-0.873,2.087C15.693,21.189,14.938,21.5,14.13,21.5z" ></path>
                                                    <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M15.5,4c0,0-2.875,3-11.5,3c0,0,0,18,11.5,21C27,25,27,7,27,7C18.375,7,15.5,4,15.5,4z M15.5,26.984  C6.567,24.43,5.217,11.608,5.015,7.965C11.052,7.797,14.213,6.15,15.5,5.251c1.287,0.899,4.448,2.545,10.484,2.713  C25.782,11.608,24.434,24.43,15.5,26.984z M22.27,10.37c-0.479-0.47-1.1-0.73-1.77-0.73s-1.29,0.261-1.77,0.73L14.1,15  c-0.92,0.01-1.79,0.37-2.44,1.03c-1.37,1.358-1.37,3.579,0,4.95c0.66,0.66,1.54,1.02,2.47,1.02c0.94,0,1.82-0.359,2.479-1.02  c0.66-0.66,1.021-1.53,1.021-2.44l4.64-4.64C22.74,13.43,23,12.81,23,12.14C23,11.47,22.74,10.84,22.27,10.37z M21.561,13.2  l-4.949,4.95c0.1,0.75-0.13,1.539-0.71,2.119C15.41,20.76,14.77,21,14.13,21c-0.64,0-1.28-0.24-1.76-0.73  c-0.98-0.979-0.98-2.56,0-3.539c0.49-0.489,1.12-0.729,1.76-0.729c0.12,0,0.24,0.01,0.36,0.03l4.949-4.95  c0.291-0.3,0.681-0.44,1.061-0.44s0.77,0.141,1.061,0.44C22.15,11.66,22.15,12.61,21.561,13.2z M19.79,12.14l0.71,0.7l-5.02,5.021  c0.27,0.56,0.18,1.238-0.29,1.699c-0.58,0.59-1.53,0.59-2.12,0c-0.58-0.58-0.58-1.529,0-2.119c0.47-0.461,1.16-0.562,1.71-0.291  L19.79,12.14z M16,11H9v-1h7V11z M14,13H9v-1h5V13z"></path>
                                                </svg>Security
                                            </a> -->
                                            <!-- <a href="identification.html" class="list-group-item list-group-item-action border-0 ">
                                                <svg xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" class="me-3">
                                                    <path xmlns="http://www.w3.org/2000/svg" d="M4,12c0-4.418,3.582-8,8-8s8,3.582,8,8s-3.582,8-8,8S4,16.418,4,12z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                                    <path xmlns="http://www.w3.org/2000/svg" style="opacity:0.7;" d="M12,17.25c-1.689,0-3.265-0.909-4.113-2.372l1.298-0.752C9.766,15.128,10.844,15.75,12,15.75  c1.162,0,2.244-0.628,2.823-1.639l1.301,0.746C15.279,16.333,13.699,17.25,12,17.25z M8.5,12c0.552,0,1-0.672,1-1.5S9.052,9,8.5,9  s-1,0.672-1,1.5S7.948,12,8.5,12z M15.5,12c0.552,0,1-0.672,1-1.5S16.052,9,15.5,9c-0.552,0-1,0.672-1,1.5S14.948,12,15.5,12z"></path>
                                                    <path xmlns="http://www.w3.org/2000/svg" class="st0" id="shock_x5F_color"  d="M4,6H2V2h4v2H4V6z M22,2h-4v2h2v2h2V2z M6,20H4v-2H2v4h4V20z M5,11H2v2h3V11z   M22,11h-3v2h3V11z M13,19h-2v3h2V19z M13,2h-2v3h2V2z M22,18h-2v2h-2v2h4V18z"></path>
                                                </svg>Identification
                                            </a> -->
                                            <!-- <a href="referral.html" class="list-group-item list-group-item-action border-0 ">
                                                <svg xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="24px" height="24px" viewBox="0 0 32 32" class="me-3">
                                                <path xmlns="http://www.w3.org/2000/svg"  d="M15,5v12c0,0,0,2-2,2H5c0,0-2,0-2-2L3.01,4.89C3.04,4.46,3.29,3,5,3h8C13,3,15,3,15,5z   M27,13h-8c-1.71,0-1.96,1.46-1.99,1.89L17,27c0,2,2,2,2,2h8c2,0,2-2,2-2V15C29,13,27,13,27,13z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                                <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M13,3H5C3.29,3,3.04,4.46,3.01,4.89L3,17c0,2,2,2,2,2h8c2,0,2-2,2-2V5C15,3,13,3,13,3z M9,12.5  c-1.93,0-3.5-1.57-3.5-3.5S7.07,5.5,9,5.5s3.5,1.57,3.5,3.5S10.93,12.5,9,12.5z"></path>
                                                <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M14,16.12l0.99,0.99C14.96,17.54,14.71,19,13,19H5c0,0-2,0-2-2V5c0,0,0-2,2-2h8c0,0,2,0,2,2v7.88l-1-1V5  c0-0.8-0.55-0.99-1.01-1H5C4.19,4,4.01,4.55,4,5.01V17c0,0.81,0.55,0.99,1.01,1H13c0.81,0,0.99-0.55,1-1.01V16.12z M27,13h-8  c-1.71,0-1.96,1.46-1.99,1.89L18,15.88v-0.87c0.01-0.46,0.19-1.01,1-1.01h7.99c0.46,0.01,1.01,0.2,1.01,1v11.99  C27.99,27.45,27.81,28,27,28h-7.99C18.55,27.99,18,27.81,18,27v-6.88l-1-1V27c0,2,2,2,2,2h8c2,0,2-2,2-2V15C29,13,27,13,27,13z   M23,20h1v4h-4v-1h2.3L11.45,12.15C10.77,12.69,9.92,13,9,13c-2.21,0-4-1.79-4-4s1.79-4,4-4s4,1.79,4,4c0,0.92-0.31,1.77-0.85,2.45  L23,22.3V20z M12,9c0-1.65-1.35-3-3-3S6,7.35,6,9s1.35,3,3,3c0.64,0,1.25-0.21,1.74-0.56L9.15,9.85l0.7-0.7l1.59,1.59  C11.79,10.25,12,9.64,12,9z M22,26h4v-4h-1v3h-3V26z"></path>
                                                </svg>Referral</a> -->
                                            <!-- <a href="coupons.html" class="list-group-item list-group-item-action border-0 ">
                                                <svg xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38" class="me-3">
                                                    <rect xmlns="http://www.w3.org/2000/svg"  x="6" y="10"  width="26" height="18" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></rect>
                                                    <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M12,18H8v2h4V18z M20,26h-2v-2.056c-1.14-0.138-1.996-0.532-2.703-1.231l1.406-1.422  C17.212,21.795,17.878,22,19,22c0.02,0,2-0.012,2-1c0-0.438-0.143-0.649-0.545-0.809C19.968,19.999,19.329,20,19,20  c-0.421,0.007-1.349,0.001-2.19-0.332C15.643,19.207,15,18.26,15,17c0-1.723,1.388-2.654,3-2.919V12h2v2.056  c1.14,0.137,1.996,0.532,2.703,1.231l-1.406,1.422C20.787,16.206,20.122,16,19,16c-0.02,0-2,0.011-2,1  c0,0.438,0.143,0.649,0.545,0.809C18.032,18.001,18.688,18.002,19,18c0.44,0.012,1.349,0,2.19,0.332C22.357,18.793,23,19.74,23,21  c0,1.723-1.388,2.654-3,2.92V26z M12,30h6v2h-6V30z M20,30h6v2h-6V30z M28,30h6v2h-6V30z M4,30h6v2H4V30z M12,6h6v2h-6V6z M20,6h6v2  h-6V6z M28,6h6v2h-6V6z M4,6h6v2H4V6z M2,22v-6h2v6H2z M2,14V8h2v6H2z M2,30v-6h2v6H2z M34,22v-6h2v6H34z M34,14V8h2v6H34z M34,30  v-6h2v6H34z"></path>
                                                </svg>Reward Center
                                            </a> -->
                                            <a href="logout.php" class="list-group-item list-group-item-action border-0 ">
                                                <svg xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" class="me-3">
                                                <rect xmlns="http://www.w3.org/2000/svg" class="st0" width="24" height="24" style="fill:none;;" fill="none"></rect>
                                                <path xmlns="http://www.w3.org/2000/svg"  d="M20,4c0-1.104-0.896-2-2-2H6C4.896,2,4,2.896,4,4v16c0,1.104,0.896,2,2,2h12  c1.104,0,2-0.896,2-2V4z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                                <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M15,6.81v2.56c0.62,0.7,1,1.62,1,2.63c0,2.21-1.79,4-4,4s-4-1.79-4-4c0-1.01,0.38-1.93,1-2.63V6.81  C7.21,7.84,6,9.78,6,12c0,3.31,2.69,6,6,6c3.31,0,6-2.69,6-6C18,9.78,16.79,7.84,15,6.81z M13,6.09C12.68,6.03,12.34,6,12,6  s-0.68,0.03-1,0.09V12h2V6.09z"></path>
                                                </svg>Signout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- menu toggler -->
                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                            <span class="fa fa-bars"></span>
                        </button>
        
                        <!-- main menu Search-->
                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 d-flex align-items-center">
                            
                            
                        </div>
                        
                    </div>
                </nav>
            </div>