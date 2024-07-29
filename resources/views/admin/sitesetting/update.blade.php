@extends('admin.layouts.master')

@section('content')
<div class="container">
    <form action="{{ route('admin.sitesetting.update', $sitesetting->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <fieldset>
            <legend style="color: blue">Update Office Information</legend>
            <div class="form-group">
                <label for="office_name">Office Name:</label>
                <input type="text" class="form-control" name="office_details[office_name]" value="{{ $sitesetting->officeDetails->office_name ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="office_phone">Office Phone:</label>
                <input type="tel" class="form-control" name="office_details[office_phone]" value="{{ $sitesetting->officeDetails->office_phone ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="office_mail">Office Email:</label>
                <input type="email" class="form-control" name="office_details[office_mail]" value="{{ $sitesetting->officeDetails->office_email ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="office_address">Office Address:</label>
                <input type="text" class="form-control" name="office_details[office_address]" value="{{ $sitesetting->officeDetails->office_address ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="office_whatsapp">Office WhatsApp:</label>
                <input type="text" class="form-control" name="office_details[office_whatsapp]" value="{{ $sitesetting->officeDetails->office_whatsapp ?? '' }}" >
            </div>
            <div class="form-group">
                <label for="estd_year">Established Year:</label>
                <input type="number" class="form-control" name="office_details[estd_year]" value="{{ $sitesetting->officeDetails->estd_year ?? '' }}" required>
            </div>
        </fieldset>

        </fieldset>

        <fieldset>
            <legend style="color: blue">Social Media Links</legend>
            <div class="form-group">
                <label for="facebook_link">Facebook Page Link:</label>
                <input type="url" class="form-control" name="social_links[facebook_link]" value="{{ $sitesetting->socialLinks->facebook_link ?? '' }}">
            </div>
            <div class="form-group">
                <label for="insta_link">Instagram Profile Link:</label>
                <input type="url" class="form-control" name="social_links[insta_link]" value="{{ $sitesetting->socialLinks->insta_link ?? '' }}">
            </div>
            <div class="form-group">
                <label for="insta_link">Linkedin Profile Link:</label>
                <input type="url" class="form-control" name="social_links[linkedin_link]" value="{{ $sitesetting->socialLinks->linkedin_link ?? '' }}">
            </div>
            <div class="form-group">
                <label for="insta_link">Pinterest Profile Link:</label>
                <input type="url" class="form-control" name="social_links[pinterest_link]" value="{{ $sitesetting->socialLinks->pinterest_link ?? '' }}">
            </div>

            <div class="form-group">
                <label for="insta_link">Twitter Profile Link:</label>
                <input type="url" class="form-control" name="social_links[twitter_link]" value="{{ $sitesetting->socialLinks->twitter_link ?? '' }}">
            </div>

            <div class="form-group">
                <label for="insta_link">Google Maps:</label>
                <input type="url" class="form-control" name="social_links[google_maps]" value="{{ $sitesetting->socialLinks->google_maps ?? '' }}">
            </div>

            <div class="form-group">
                <label for="insta_link">Facebook Page:</label>
                <input type="text" class="form-control" name="social_links[facebook_page]" value="{{ $sitesetting->socialLinks->facebook_page ?? '' }}">
            </div>




        </fieldset>

        <fieldset>
            <legend style="color: blue">Branding Elements</legend>
            {{-- <div class="form-group">
                <label for="main_logo">Main Logo:</label>
                <input type="file" class="form-control-file" name="logos[main_logo]"  value="{{ $sitesetting->logos['main_logo'] ?? '' }}">
            </div> --}}

            <div class="form-group mb-3">
                <label for="">Main Logo</label>
                <input type="file" name="logos[main_logo]" value="{{$sitesetting->logos['main_logo'] ?? ''}}" class="form-control" id="mainLogoInput">
                <img src="{{ asset('storage/' . $sitesetting->logos['main_logo'] ?? '') }}"  id="mainLogoPreview">
            </div>
 
            
            
            <div class="form-group mb-3">
                <label for="">Side Logo</label>
                <input type="file" name="logos[side_logo]" value="{{$sitesetting->logos['side_logo'] ?? ''}}" class="form-control" id="sideLogoInput">
                <img src="{{ asset('storage/' . $sitesetting->logos['side_logo'] ?? '') }}" id="sideLogoPreview">
            </div>
 
        </fieldset>

            <div class="form-group">
                <label for="slogan">Slogan:</label>
                <input type="text" class="form-control" name="others[slogan]" value="{{ $sitesetting->others['slogan'] ?? '' }}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="others[description]" rows="4" cols="50">{{ $sitesetting->others['description'] ?? '' }}</textarea>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- JavaScript for image preview -->
<script>
    $(document).ready(function() {
        // Main Logo preview
        $('#mainLogoInput').change(function() {
            readURL(this, '#mainLogoPreview');
        });

        // Side Logo preview
        $('#sideLogoInput').change(function() {
            readURL(this, '#sideLogoPreview');
        });

        // Function to read selected image and display it in the preview
        function readURL(input, previewElement) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(previewElement).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endsection