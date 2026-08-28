<div class="row">
    <div class="col-4">
        <!-- A button for drop down of area selection -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @{{ selectedAreaText }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a v-for="area in areas" class="dropdown-item"  @click="changeArea(area.id,area.name)" >@{{ area.name }}</a>
                
            </div>
        </div>

        <!-- A button for drop down of data selection -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @{{ selectedDateText }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a v-for="date in dates" class="dropdown-item"  @click="changeDate(date.date,date.name)" >@{{ date.name }}</a>
                
            </div>
        </div>
    </div>
    <div class="col-1">
        <!-- Center -->
    </div>
    <div class="col-7 text-right ">
        <!-- Widget, button with icon no text -->
        <a href="{{ route('webreswidget.edit') }}" class="btn btn-icon btn-success-outline" type="button">
            <span class="btn-inner--icon"><i class="fas fa-code"></i></span>
        </a>
      
        <!-- All reservations -->
        <a href="{{ route('tablereservations.index') }}" class="btn btn-icon btn-success" type="button">
            <span class="btn-inner--text">{{ __('All reservations') }}</span>
        </a>
        <!-- Walk in customer -->
        <a href="{{ route('tablereservations.create') }}?status=seated" class="btn btn-icon btn-success" type="button">
           
            <span class="btn-inner--text">{{ __('Walk in customer') }}</span>
        </a>
         <!-- Phone reservation -->
         <a href="{{ route('tablereservations.create') }}" class="btn btn-icon btn-success" type="button">
            
            <span class="btn-inner--text">{{ __('Phone reservation') }}</span>
         </a>
    </div>
</div>