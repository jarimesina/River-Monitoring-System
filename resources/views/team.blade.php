@extends('layouts.app')
@section('content')

<body class="bod2">
<div class="container cont">
<div class="row">
<div class="col-12">
<h1 class="page-title mt-3">About the Team</h1> 
<p class="para text-justify px-3 py-4 sub">The team behind the development of this River Monitoring System is 
    composed of 5th year BS Computer Engineering students at the University of San Carlos in Cebu City. </p>
    <div class="profiles">
        <div class="row mt-4 w-100">
            <div class="col-4 text-center blck">
                <img src="{{asset('/images/jari.jpg')}}">
                <p class="font-bold"> Jari Sebastian Mesina </p>
            </div>
            <div class="col-8 text-center d-flex nxtblck">
                <p class="para text-justify align-self-center px-5">  Jari is the Project Manager of Scorpion and 
                    facilitates the work in the group. 
                    He spearheads the web development; specifically, in the backend and database. 
                    He supports his members in any way he can.
                </p>
            </div>
        </div>
        <div class="row mt-4 w-100">
            <div class="col-8 text-center d-flex nxtblck">
                <p class="para text-justify align-self-center px-5">Vanessa is the group's treasurer, making sure that the group
                    always have funds for when materials (and snacks) need to be purchased. She also helps Jari in the web development,
                    specifically, in the front-end.</p>
            </div>
            <div class="col-4 text-center blck">
                <img src="{{asset('/images/bani.jpg')}}">
                <p class="font-bold"> Vanessa Ruth Baylon </p>
            </div>
        </div>
        <div class="row mt-4 w-100">
            <div class="col-4 text-center blck">
                <img src="{{asset('/images/ergie.jpg')}}">
                <p class="font-bold"> Ergie Empuerto </p>
            </div>
            <div class="col-8 text-center d-flex nxtblck">
                <p class="para text-justify align-self-center px-5"> Ergie works on the documents required for submission by the research course.
                    She also aids in the development of the water level sensor and water velocity meter.</p>
            </div>
        </div>
        <div class="row mt-4 w-100">
            <div class="col-8 text-center d-flex nxtblck">
                <p class="para text-justify align-self-center px-5">Kristal is in-charge of communications. She makes sure the group gets
                    everything we need, from materials and professional aid to support. Kristal also helps in the calculations to obtain the 
                    river volumetric flow rate from the data gathered by the device.</p>
            </div>
            <div class="col-4 text-center blck">
                <img src="{{asset('/images/tal.jpg')}}">
                <p class="font-bold"> Kristal Kilat </p>
            </div>
        </div>
        <div class="row mt-4 w-100">
            <div class="col-4 text-center blck">
                <img src="{{asset('/images/jez.jpg')}}">
                <p class="font-bold"> Jezreel Tan </p>
            </div>
            <div class="col-8 text-center d-flex nxtblck">
                <p class="para text-justify align-self-center px-5">Jezreel oversees the design and development of the various prototypes and modules. 
                In addition, he provides insightful input during planning and meetings and leads the testing of the prototypes.</p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="credits">
Background Photo by <a href="https://unsplash.com/@paulberthelon">Paul Berthelon Bravo</a>
</div>
</body>
@endsection
