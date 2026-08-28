<!-- header -->
<div class="flex justify-between items-center flex-row" style="height: 200px;">
    <div style="background-position: 50%; background-image: url('{{ $restorant->coverm  }}'); height: 100%;"
        class="w-full bg-cover bg-center">
        <div class="bg-black/40 backdrop-brightness-100 w-full h-full">

        <!--  Content -->
        <div class="flex flex-row packer justify-between items-center w-full h-full row">

            <!-- Left column - Image and Name only -->
            <div class="flex h-full flex-col text-white justify-center items-start px-6 col-md-6 col-sm-12">
                <!-- Icon and Name in a row -->
                <div class="flex items-center space-x-4">
                    <picture class="flex object-none overflow-hidden relative mx-0 mt-0 w-16 h-16 border-2 border-white border-solid shadow-lg" style="border-radius: 50%;">
                        <img loading="lazy" src="{{ $restorant->logom }}" class="block relative p-0 m-0 max-w-full align-middle border-0 border-none" />
                    </picture>
                    <h1 class="text-3xl font-bold text-white">
                        {{ $restorant->name }}
                    </h1>
                    
                    
                </div>
                
            </div>
        </div>
        </div>
    </div>
</div>

<script>
function scrollToSection(sectionID) {
    document.querySelectorAll('.content-tab').forEach(function(el) {
        el.classList.remove('expanded');
    });

    document.getElementById(sectionID).classList.add('expanded');

    $('html, body').animate({
        scrollTop: $("#"+sectionID).offset().top - 100
    }, 500);
}

// Toggle language dropdown
document.addEventListener('DOMContentLoaded', function() {
    /*const langButton = document.querySelector('.language-dropdown').previousElementSibling;
    if (langButton) {
        langButton.addEventListener('click', function() {
            document.querySelector('.language-dropdown').classList.toggle('hidden');
        });
    }*/
});
</script> 