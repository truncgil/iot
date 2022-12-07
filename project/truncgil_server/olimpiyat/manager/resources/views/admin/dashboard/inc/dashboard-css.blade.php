<style>
    .komutlar .widget .block-content {
        height:300px;
    }
    .komutlar .widget .block-header {
        display:none;
    }
    .css-switch {
        transform: scale(2);
        margin: 70px 0;
    }  
    .reset  {
        transform: scale(1.5);
        margin: 100px 0;
    }
    @media screen and (max-width:768px) {
        .komutlar .widget .block-content {
            height:300px;
        }
        .css-switch {
            transform: scale(1.5);
            margin: 40px 0;
        } 

    }
    .css-switch.css-control-lg .css-control-input~.css-control-indicator::after {
        content: '{{e2("Kapalı")}}';
        font-size:11px;
        padding-top:6px;
    }
    .css-switch.css-control-lg .css-control-input:checked~.css-control-indicator::after {
        content: '{{e2("Açık")}}';
    }
</style>