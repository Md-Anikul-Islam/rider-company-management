<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Trip Verification</title>
		<link
			rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"
		/>

		<style>
		* {
        				margin: 0;
        				padding: 0;
        				box-sizing: border-box;
        			}
        			body {
        				background-color: #f4f4f4;
        				font-family: 'Inter', sans-serif;
        			}
        			.max_width_area {
        				width: 100%;
        				max-width: 1270px;
        				margin: 0 auto;
        				padding: 0px 15px;
        			}
        			.header_area {
        				background: black;
        				padding: 10px 50px;
        			}
        			.logo_area img {
        				height: 60px;
        			}
        			.trip_details_wrap {
        				padding: 50px 15px;
        				display: flex;
        				flex-wrap: wrap;
        				gap: 20px;
        			}
        			.trip_card {
        				background-color: #fff;
        				border-radius: 5px;
        				flex-grow: 1;
        				flex-basis: 400px;
        				width: 400px;
        			}
        			.heading {
        				padding: 10px 20px;
        				border-bottom: 1px solid #ddd;
        				display: flex;
        				justify-content: space-between;
        				align-items: center;
        			}
        			.heading h2 {
        				font-size: 20px;
        				font-weight: 700;
        				line-height: 28px;
        			}
        			.trip_status {
        				background-color: #48b02c;
        				color: #fff;
        				padding: 5px 10px;
        				border-radius: 5px;
        				font-size: 12px;
        				text-transform: uppercase;
        				letter-spacing: 1px;
        			}
        			.details {
        				padding: 30px;
        			}
        			.details img {
        				height: 120px;
        				border-radius: 200px;
        				margin-bottom: 20px;
        			}
        			.details h2 {
        				text-align: left;
        				font-size: 22px;
        				line-height: 30px;
        				font-weight: 600;
        			}
        			.details ul {
        			    margin-top: 10px;
        				text-align: left;
        				list-style: none;
        				padding: 0;
        			}
        			.details ul li {
        				display: flex;
        				align-items: center;
        				margin-bottom: 7px;
        				gap: 10px;
        				color: #99a1b7;
        				font-size: 16px;
        				line-height: 24px;
        			}
        			.car_details ul {
        				display: flex;
        				align-items: center;
        				gap: 15px;
        			}
        			.details ul li svg {
        				width: 20px;
        				height: 20px;
        			}
        			.car_details_info {
        				display: flex;
        				align-items: center;
        				justify-content: space-between;
        				gap: 5px;
        				margin-top: 10px;
        			}
        			.car_details_info .item {
        				text-align: left;
        			}
        			.car_details_info .item h3 {
        				font-size: 16px;
        				margin-bottom: 4px;
        			}
        			.car_details_info .item span {
        				color: #99a1b7;
        			}
        			.timeline {
        				display: flex;
        				flex-direction: column;
        				gap: 20px;
        				margin-bottom: 30px;
        			}
        			.timeline_item {
        				display: flex;
        				gap: 10px;
        				position: relative;
        			}
        			.timeline_item {
        				display: flex;
        				gap: 10px;
        			}
        			.timeline_line {
        				position: absolute;
        				top: 18px;
        				width: 1px;
        				height: 85px;
        				background: #040404;
        				left: 11.5px;
        			}
        			.timeline_icon svg {
        				width: 24px;
        				height: 24px;
        			}
        			.timeline_content {
        				display: flex;
        				flex-direction: column;
        				gap: 8px;
        			}
        			.timeline_content span {
        				font-size: 20px;
        				font-weight: 300;
        			}
        			.timeline_content h4 {
        				font-weight: 800;
        				font-size: 18px;
        			}
        			.timeline_content p {
        				color: #99a1b7;
        				font-size: 14px;
        			}
        			.details h5 {
        				font-size: 25px;
        				font-weight: 800;
        				line-height: 38px;
        			}
</style>
	</head>
	<body>
		<header class="header_area">
			<div class="logo_area max_width_area">
				<img
					src="https://driveon.etldev.xyz/backend/media/logos/drive.jpg"
					alt=""
				/>
			</div>
		</header>
		<section class="trip_details_wrap max_width_area">
			<div class="trip_card">
				<div class="heading">
					<h2>Company Information</h2>
				</div>
				<div class="details">
					<img
						src="{{asset($tripVerify->company->logo)}}"
						alt=""
					/>
					<h2>{{$tripVerify->company->name}}</h2>
					<ul>
						<li>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<circle cx="12" cy="10" r="3" />
								<path
									d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"
								/>
							</svg>
							{{$tripVerify->company->address}}
						</li>
						<li>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<path
									d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
								></path>
							</svg>
							{{$tripVerify->company->phone}}
						</li>
						<li>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<path
									d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
								></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
							{{$tripVerify->company->email}}
						</li>
					</ul>
				</div>
			</div>
			<div class="trip_card">
				<div class="heading">
					<h2>Driver Information</h2>
				</div>
				<div class="details">
					@if($tripVerify->driver->profile)
                        <img
                            src="{{asset($tripVerify->driver->profile)}}"
                            alt=""
                        />
					@else
                        <img
                            src="{{asset('pro.png')}}"
                            alt=""
                        />
                    @endif
					<h2>{{$tripVerify->driver->name}}</h2>
					<ul>
						<li>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<circle cx="12" cy="10" r="3" />
								<path
									d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"
								/>
							</svg>
							{{$tripVerify->driver->address}}
						</li>
						<li>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<path
									d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
								></path>
							</svg>
							{{$tripVerify->driver->phone}}
						</li>
						<li>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<path
									d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
								></path>
								<polyline points="22,6 12,13 2,6"></polyline>
							</svg>
							{{$tripVerify->driver->email}}
						</li>
					</ul>
				</div>
			</div>
			<div class="trip_card">
				<div class="heading">
					<h2>Car Information</h2>
				</div>
				<div class="details car_details">
					<img
						src="{{asset($tripVerify->driver->car->car_image)}}"
						alt=""
					/>
					<h2>{{$tripVerify->driver->car->car_name}}</h2>
                    <h4>Model: {{$tripVerify->driver->car->car_model}}</h4>
					<ul>
						<li>
							<svg
								width="10"
								height="14"
								viewBox="0 0 10 14"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									d="M5.00054 6.85626C6.46208 6.85626 7.647 5.4171 7.647 3.6418C7.647 1.86646 7.25798 0.427307 5.00054 0.427307C2.74311 0.427307 2.354 1.86646 2.354 3.6418C2.354 5.4171 3.53893 6.85626 5.00054 6.85626Z"
									fill="currentColor"
								/>
								<path
									d="M0.00198527 11.7643C0.00108387 11.7338 0.00153457 11.6561 0.00198527 11.7643V11.7643Z"
									fill="currentColor"
								/>
								<path
									d="M9.99854 11.8489C9.99902 11.6433 9.99996 11.8193 9.99854 11.8489V11.8489Z"
									fill="currentColor"
								/>
								<path
									d="M9.99296 11.6346C9.94394 8.54195 9.54004 7.66072 6.44927 7.10291C6.44927 7.10291 6.01419 7.6573 5.00012 7.6573C3.98605 7.6573 3.5509 7.10291 3.5509 7.10291C0.493852 7.65464 0.0653889 8.52279 0.00905159 11.5341C0.00443193 11.78 0.00229112 11.7929 0.00146484 11.7644C0.00165263 11.8178 0.0018779 11.9168 0.0018779 12.0893C0.0018779 12.0893 0.737718 13.5727 5.00012 13.5727C9.26245 13.5727 9.99837 12.0893 9.99837 12.0893C9.99837 11.9784 9.99844 11.9014 9.99856 11.8489C9.99773 11.8666 9.99608 11.8324 9.99296 11.6346Z"
									fill="currentColor"
								/>
							</svg>

							{{$tripVerify->driver->car->passengers}}
						</li>
						<li>
							<svg
								width="10"
								height="16"
								viewBox="0 0 10 16"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M8.875 14.0938H8.1875C7.9375 13.6562 7.46875 13.375 6.9375 13.375V7.5625H9.59375V13.3438C9.59375 13.7812 9.28125 14.0938 8.875 14.0938ZM6.5625 13.4062C6.15625 13.5 5.84375 13.75 5.65625 14.0938H4.21875C4.03125 13.75 3.71875 13.5 3.3125 13.4062V7.5625H6.5625V13.4062ZM2.9375 13.375C2.40625 13.375 1.9375 13.6562 1.6875 14.0938H1C0.59375 14.0938 0.25 13.7812 0.25 13.3438V7.5625H2.9375V13.375ZM0.25 7.21875V4.125C0.25 3.71875 0.59375 3.375 1 3.375H3.59375V4.625C3.59375 4.71875 3.6875 4.8125 3.78125 4.8125C3.875 4.8125 3.96875 4.71875 3.96875 4.625V3.375H4.75V4.625C4.75 4.71875 4.84375 4.8125 4.9375 4.8125C5.03125 4.8125 5.125 4.71875 5.125 4.625V3.375H5.90625V4.625C5.90625 4.71875 6 4.8125 6.09375 4.8125C6.1875 4.8125 6.28125 4.71875 6.28125 4.625V3.375H8.875C9.28125 3.375 9.59375 3.71875 9.59375 4.125V7.21875H0.25Z"
									fill="currentColor"
								/>
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M3.03125 15.9062C2.40625 15.9062 1.9375 15.4062 1.9375 14.8125C1.9375 14.2188 2.40625 13.7188 3.03125 13.7188C3.625 13.7188 4.09375 14.2188 4.09375 14.8125C4.09375 15.4062 3.625 15.9062 3.03125 15.9062Z"
									fill="currentColor"
								/>
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M6.96875 15.9062C6.375 15.9062 5.90625 15.4062 5.90625 14.8125C5.90625 14.2188 6.375 13.7188 6.96875 13.7188C7.59375 13.7188 8.0625 14.2188 8.0625 14.8125C8.0625 15.4062 7.59375 15.9062 6.96875 15.9062Z"
									fill="currentColor"
								/>
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M2.75 3V0.71875C2.75 0.28125 3.125 -0.09375 3.5625 -0.09375H6.3125C6.75 -0.09375 7.09375 0.28125 7.09375 0.71875V3H6.375V0.71875C6.375 0.6875 6.34375 0.65625 6.3125 0.65625H3.5625C3.53125 0.65625 3.5 0.6875 3.5 0.71875V3H2.75Z"
									fill="currentColor"
								/>
							</svg>
							{{$tripVerify->driver->car->car_bag}}
						</li>
					</ul>
					<div class="car_details_info">
						<div class="item">
							<h3>Car Make</h3>
							<span>{{$tripVerify->driver->car->car_make}}</span>
						</div>
						<div class="item">
							<h3>Car Color</h3>
							<span>{{$tripVerify->driver->car->car_color}}</span>
						</div>
						<div class="item">
							<h3>Car Plate</h3>
							<span>{{$tripVerify->driver->car->plate_no}}</span>
						</div>
						<div class="item">
							<h3>Year</h3>
							<span>{{$tripVerify->driver->car->year}}</span>
						</div>
					</div>
				</div>
			</div>

			<div class="trip_card">
				<div class="heading">
					<h2>Customer Information</h2>
				</div>
				<div class="details">
					@if($tripVerify->passenger==null)
                        <img
                            src="{{asset('pro.png')}}"
                            alt=""
                        />
                    @else
                       @if($tripVerify->passenger->profile==null)
                            <img
                                src="{{asset('pro.png')}}"
                                alt=""
                            />
                        @else
                            <img
                                src="{{asset($tripVerify->passenger->profile)}}"
                                alt=""
                            />
                        @endif
                    @endif

					<h2>
					@if($tripVerify->passenger==null)
                        {{$tripVerify->passenger_name}}
                    @else
                       {{$tripVerify->passenger->name}}
                    @endif
                    </h2>
					<ul>

						<li>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
							>
								<path
									d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
								></path>
							</svg>
							@if($tripVerify->passenger==null)
                                {{$tripVerify->passenger_phone}}
                            @else
                               {{$tripVerify->passenger->phone}}
                            @endif
						</li>
						<li>
							@if($tripVerify->passenger==null)

                            @else
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                    ></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                               {{$tripVerify->passenger->email}}
                            @endif
						</li>
					</ul>
				</div>
			</div>

                <div class="trip_card">
				<div class="heading">
					<h2>Trip Information</h2>

					@if($tripVerify->trip_type=='request_trip')
                       <div class="trip_status">Request Trip</div>
                    @else
                        <div class="trip_status">Manual Trip</div>
                    @endif





				</div>
				<div class="details">
					<div class="timeline">
						<div class="timeline_item">
							<div class="timeline_line"></div>
							<div class="timeline_icon">
								<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="6.5" cy="6.5" r="6.5" fill="currentColor"></circle>
									<circle cx="6.5" cy="6.5" r="2.5" fill="white"></circle>
								</svg>
							</div>
							<div class="timeline_content">
								<span>Pickup Location</span>
								<h4>{{$tripVerify->origin_address}}</h4>
						        <p>{{ \Carbon\Carbon::parse($tripVerify->created_at)->format('d M Y') }}</p>
							</div>
						</div>
						<div class="timeline_item">
							<div class="timeline_icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
									<g clip-path="url(#clip0_1270_2574)">
										<path d="M8 0C6.40935 0.00211004 4.88445 0.634929 3.75969 1.75969C2.63493 2.88445 2.00211 4.40935 2 6C2 10.3075 7.59 15.7025 7.8275 15.93C7.8737 15.9749 7.93558 16 8 16C8.06442 16 8.1263 15.9749 8.1725 15.93C8.41 15.7025 14 10.3075 14 6C13.9979 4.40935 13.3651 2.88445 12.2403 1.75969C11.1155 0.634929 9.59065 0.00211004 8 0ZM8 8.75C7.4561 8.75 6.92442 8.58871 6.47218 8.28654C6.01995 7.98437 5.66747 7.55488 5.45933 7.05238C5.25119 6.54988 5.19673 5.99695 5.30284 5.4635C5.40895 4.93005 5.67086 4.44005 6.05546 4.05546C6.44005 3.67086 6.93005 3.40895 7.4635 3.30284C7.99695 3.19673 8.54988 3.25119 9.05238 3.45933C9.55488 3.66747 9.98437 4.01995 10.2865 4.47218C10.5887 4.92442 10.75 5.4561 10.75 6C10.7496 6.72921 10.4597 7.42843 9.94406 7.94406C9.42843 8.45969 8.72921 8.74956 8 8.75Z" fill="#FC0404"></path>
									</g>
									<defs>
										<clipPath id="clip0_1270_2574">
											<rect width="16" height="16" fill="white"></rect>
										</clipPath>
									</defs>
								</svg>
							</div>
							<div class="timeline_content">
								<span>Drop Location</span>
								<h4>{{$tripVerify->destination_address}}</h4>
								<p>{{ \Carbon\Carbon::parse($tripVerify->created_at)->format('d M Y') }} </p>
							</div>
						</div>
					</div>
					<h5>Total Fare:

					@if($tripVerify->fare_received_status==0)
                        ${{$tripVerify->calculated_fare}}
                    @elseif($tripVerify->fare_received_status==1)
                        ${{$tripVerify->estimated_fare}}
                    @endif


					</h5>
				</div>
			</div>
		</section>
	</body>
</html>
