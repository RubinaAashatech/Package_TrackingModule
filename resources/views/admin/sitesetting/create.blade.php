@extends('admin.layouts.master')

@section('content')
<div class="container">
    <form action="{{ route('admin.sitesetting.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend style="color: blue">Basic Office Information</legend>
            <div class="form-group">
                <label for="office_name" >Office Name:</label>
                <input type="text" class="form-control" name="office_details[office_name]" required>
            </div>
            <div class="form-group">
                <label for="office_phone">Office Phone:</label>
                <input type="tel" class="form-control" name="office_details[office_phone]" required>
            </div>
            <div class="form-group">
                <label for="office_mail">Office Email:</label>
                <input type="email" class="form-control" name="office_details[office_mail]" required>
            </div>
            <div class="form-group">
                <label for="office_address">Office Address:</label>
                <input type="text" class="form-control" name="office_details[office_address]" required>
            </div>
            <div class="form-group">
                <label for="office_whatsapp">Office WhatsApp:</label>
                <input type="text" class="form-control" name="office_details[office_whatsapp]" >
            </div>
            <div class="form-group">
                <label for="estd_year">Established Year:</label>
                <input type="number" class="form-control" name="office_details[estd_year]" required>
            </div>
        </fieldset>

        <fieldset>
            <legend style="color: blue">Social Media Links</legend>
            <div class="form-group">
                <label for="facebook_link">Facebook Page Link:</label>
                <input type="url" class="form-control" name="social_links[facebook_link]">
            </div>
            <div class="form-group">
                <label for="insta_link">Instagram Profile Link:</label>
                <input type="url" class="form-control" name="social_links[insta_link]">
            </div>
            <div class="form-group">
                <label for="linkedin_link">LinkedIn Profile Link:</label>
                <input type="url" class="form-control" name="social_links[linkedin_link]">
            </div>
            <div class="form-group">
                <label for="pinterest_link">Pinterest Profile Link:</label>
                <input type="url" class="form-control" name="social_links[pinterest_link]">
            </div>
            <div class="form-group">
                <label for="twitter_link">Twitter Profile Link:</label>
                <input type="url" class="form-control" name="social_links[twitter_link]">
            </div>
        </fieldset>

        <fieldset>
            <legend style="color: blue">Additional Information</legend>
            <div class="form-group">
                <label for="google_maps">Google Maps Location:</label>
                <input type="url" class="form-control" name="social_links[google_maps]">
            </div>
            <div class="form-group">
                <label for="facebook_page">Facebook Page Name:</label>
                <input type="text" class="form-control" name="social_links[facebook_page]">
            </div>
        </fieldset>

        <fieldset>
            <legend style="color: blue">Branding Elements</legend>
            <div class="form-group">
                <label for="main_logo">Main Logo:</label>
                <input type="file" class="form-control-file" name="logos[main_logo]" accept="image/png, image/jpeg, image/svg+xml">
            </div>
            <div class="form-group">
                <label for="side_logo">Side Logo:</label>
                <input type="file" class="form-control-file" name="logos[side_logo]" accept="image/png, image/jpeg, image/svg+xml">
            </div>
            <div class="form-group">
                <label for="slogan">Slogan:</label>
                <input type="text" class="form-control" name="others[slogan]">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="others[description]" rows="4" cols="50"></textarea>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection