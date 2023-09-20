<?php

namespace App\Http\Livewire\Panel\Order\Traits;

trait AutocompleteTrait
{
    public function updatedStationStartAutocomplete()
    {
        $this->form_options['station_start'] = $this->initSelectOptions($this->form_shape['station_start'], $this->model, 'name', $this->station_start_autocomplete);
    }

    public function updatedStationEndAutocomplete()
    {
        $this->form_options['station_end'] = $this->initSelectOptions($this->form_shape['station_end'], $this->model, 'name', $this->station_end_autocomplete);
    }

    public function updatedCompanySourceAutocomplete()
    {
        $this->form_options['company_source'] = $this->initSelectOptions($this->form_shape['company_source'], $this->model, 'name', $this->company_source_autocomplete);
    }

    public function updatedCompanyDestinationAutocomplete()
    {
        $this->form_options['company_destination'] = $this->initSelectOptions($this->form_shape['company_destination'], $this->model, 'name', $this->company_destination_autocomplete);
    }
}
