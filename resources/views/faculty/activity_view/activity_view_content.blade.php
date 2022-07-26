<style>    
    /* body {
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-color: #D1C4E9;
        background-repeat: no-repeat;
    } */
    
    /* .container {
        margin: 200px auto;
    } */
    
    fieldset {
        display: none;
    }
    
    fieldset.show {
        display: block;
    }
    
    select:focus, input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2196F3 !important;
        outline-width: 0 !important;
        font-weight: 400;
    }
    
    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0;
    }
    
    .tabs {
        margin: 2px 5px 0px 5px;
        padding-bottom: 10px;
        cursor: pointer;
    }
    
    .tabs:hover, .tabs.active {
        border-bottom: 1px solid #2196F3;
    }
    
    a:hover {
        text-decoration: none;
        color: #1565C0;
    }
    
    .box {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 10px;
    }
    
    .modal-backdrop { 
        background-color: #64B5F6;
    }
    
    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%;
    }
    
    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px;
        }
    }

    .button-block {
        display: block;
        width: 100%;
        border: none;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-8 col-sm-8 col-lg-8">
        <div class="hero text-white hero-bg-image hero-bg-parallax"
        style="background-image: url({{ URL::to('/images/designs/green_activity.png') }})">
            <div class="hero-inner" id="hero_header">
            </div>
            <br>
            <div class="hero-inner" id="hero_body">
            </div>
        </div>
    </div>

    <div class="col-4 col-sm-4 col-lg-4" id="right_side">
        
    </div>
</div>



{{-- END OF VIEW MODAL --}}