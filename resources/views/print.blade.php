<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    @if ($transactions->document_type == "Certificate of Indigency")
    <div class="row">
        <div class="col-sm-12">

            <div style="width: 100%;">
                <div class="row">
                    <div class="col-sm-12">
                        <center>
                            <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                            <p class="text-center; font-weight:bold">Republic of the Philippines <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                        </center>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <center>
                            <p style="font-weight: bold">{{ date("m-d-Y") }}<br>____________________________________________ <br>Date:</p>
                        </center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <center>
                            <h4>Certification of Indigency</h4>
                        </center>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                            <p class="text-justify">This is to clarify that <span style="font-weight: bold; color:black">{{ $transactions->name }}</span> of legal age, Filipino and a resident of Purok <span style="font-weight: bold; color:black">{{ $transactions->address }}</span> is in the list of indigent families of Barangay Old Nongnongan, Don Carlos, Bukidnon. </p>
                            <p class="text-justify">This certificatio is issued for <span style="font-weight: bold; color:black">{{ $transactions->purpose }}</span> only to it may serve</p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <center>
                            @php
                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                        @endphp
                        <p style="font-weight: bold">{{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                        </center>

                    </div>
                </div>

            </div>

        </div>
    </div>
    @elseif($transactions->document_type == "Barangay Clearance")
    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <div class="col-sm-3">
                    <center>
                        <img src="{{ asset('/images/logo.png') }}" class="img-fluid" style="width:100px">
                    </center>
                </div>
                <div class="col-sm-6">
                    <center>
                        <p class="text-center; font-weight:bold"><span style="font-weight: bold; font-size:14pt">Republic of the Philippines</span> <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                    </center>

                </div>
                <div class="col-sm-3">
                    <center>
                        <img src="{{ asset('/images/municipality_logo.png') }}" class="img-fluid" style="width:100px">
                    </center>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <div style="width:50%; background-color:yellow; margin:auto; padding:20px; border-radius:10px;">
                        <h3 class="text-center" style="font-weight: bolder">BARANGAY CLEARANCE</h3>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-12">
                    <h4>TO WHOME IT MAY CONCERN :</h4>
                    <p class="text-center">THIS IS TO CERTIFY that the name written below has requested record clearance from this office and verified with the following findings:</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="row">
                        <div class="col-sm-10">

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">NAME</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->name }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">ADDRESS</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->address }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">DATE OF BIRTH</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->bday }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">PLACE OF BIRTH</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->bplace }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">SEX</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->sex }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">CIVIL STATUS</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->civil_status }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">PURPOSE</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->purpose }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">VALID UNTIL</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->validity }}</h5>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">O.R NO.#</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">: {{ $transactions->or_no }}</h5>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h5 class="text-start">RES. CERT. NO.#</h5>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="text-start">:</h5>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div style="width:200px; height:200px; border:1px solid black; border-radius:10px; margin:auto">

                                <center>

                                    @php
                                        $get_image_existence = App\Models\UserIdPic::where('user_id', $transactions->user_id)->count();
                                        $get_id = App\Models\UserIdPic::where('user_id', $transactions->user_id)->get();
                                    @endphp

                                    @if ($get_image_existence == 0)
                                        <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="vertical-align: middle;">

                                    @else
                                        @foreach ($get_id as $item_get_id)
                                            <img src="{{ asset('storage/'. $item_get_id->path) }}" class="img-fluid" alt="User Image" style="width:100%">

                                        @endforeach
                                    @endif


                                </center>


                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p class="text-start">The above mentioned name is a law abiding citizens and found <b>NO DEROGATORY RECORDS</b> as far as the office is concerned</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p class="text-start">Issued this {{ \Carbon\Carbon::today()->format('jS \d\a\y \o\f F Y') }} at the office of the PUNONG BARANGAY OLD NONGNONGAN, DON CARLOS, BUKIDNON.</p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-3">
                    <center>
                        <p class="text-start"><b>Prepared by: <br> {{ auth()->user()->complete_name }} <br> __________________________________ <br> {{ auth()->user()->role }}</b></p>
                    </center>
                </div>
                <div class="col-sm-9">


                </div>
            </div>

            <div class="row">
                <div class="col-sm-9">

                </div>
                <div class="col-sm-3">
                    @php
                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                        @endphp

                    <p class="text-center" style="font-weight: bold">Noted By: <br> {{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                </div>
            </div>


        </div>
    </div>

    @elseif($transactions->document_type == "Barangay Certification")
        <div class="row">
            <div class="col-sm-12">
                <center>
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                    <p class="text-center; font-weight:bold">Republic of the Philippines <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                </center>
                <hr>

                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <center>

                            <p style="font-weight: bold">{{ date("m-d-Y") }}<br>____________________________________________ <br>Date:</p>
                        </center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <center>
                            <h4>BARANGAY CERTIFICATION</h4>
                        </center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-start">This is to certify that <span style="font-weight: bold;">{{ $transactions->get_user->complete_name }}</span> age <span style="font-weight: bold">{{ Carbon\Carbon::parse($transactions->get_user->bday)->age }}</span>, Filipino and a resident of Purok <span style="font-weight: bold">{{ $transactions->address }}</span>.</p>
                        <p class="text-start"><span style="font-weight: bold"></span>{{ $transactions->get_user->complete_name }} has good community standing and law-abiding citizen with no criminal offense/activities on record in this office </p>
                        <p class="text-start">This certificatio is issued for <span style="font-weight: bold ">{{ $transactions->purpose }}</span> only to it may serve</p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <center>
                            @php
                                $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                            @endphp
                        <p style="font-weight: bold">{{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                        </center>

                    </div>
                </div>
            </div>


        </div>

    @elseif($transactions->document_type == "Barangay Cert - First-time Job Seeker")
    <h5>Barangay Cert - First-time Job Seeker</h5>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>
</html>
