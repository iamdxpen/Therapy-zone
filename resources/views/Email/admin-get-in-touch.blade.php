<p><strong>Hello</strong></p><br>
<p>Received new enquiry</p><br>

<p><strong>Name: </strong> {{$enquiry->name}}</p>
@if(!empty($enquiry->organization))
<p><strong>Organization: </strong> {{$enquiry->organization}}</p>
@endif
<p><strong>Address: </strong> {{$enquiry->address}}</p>
<p><strong>City: </strong> {{$enquiry->city}}</p>
<p><strong>Country: </strong> {{$enquiry->country}}</p>
<p><strong>Phone: </strong> {{$enquiry->phone}}</p>
<p><strong>Email: </strong> {{$enquiry->email}}</p>
<p><strong>Subject: </strong> {{$enquiry->subject}}</p>
<p><strong>Product: </strong> {{$enquiry->product}}</p>
<p><strong>Comments: </strong> {{$enquiry->comments}}</p>