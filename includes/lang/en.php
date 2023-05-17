<?php

###############################
#
# A)
## ask question
#
# B)
##
#
# C)
##
#
# D)
## Details
#
# F)
## footer
## forget password
#
# H)
## header
#
# L)
## login
#
# +M)
## members
#
# +Q)
## questions
#
# R)
## report
## register
#
# S)
## sidebar
#
###############################

$lang['rtl']      = 0;
$lang['lang']     = 'en';
$lang['close']    = 'Close';
$lang['loading']  = 'Loading...';
$lang['verified'] = 'Verified acount';
$lang['admin']    = 'Admin';




$lang['timedate']['time_second'] = "second";
$lang['timedate']['time_minute'] = "minute";
$lang['timedate']['time_hour'] = "hour";
$lang['timedate']['time_day'] = "day";
$lang['timedate']['time_week'] = "week";
$lang['timedate']['time_month'] = "month";
$lang['timedate']['time_year'] = "year";
$lang['timedate']['time_decade'] = "decade";
$lang['timedate']['time_ago'] = "ago";

# + Page: Ask
$lang['ask'] = [
	'ask_title'  => 'Ask a new question',
	'edit_title' => 'Edit question',
	'multiple'   => 'Multiple votes',
	'pinned'     => 'Pinned Question',
	'question'   => [
			'label' => 'Your Question:',
			'place' => 'Fill your question',
			'p'     => 'No HTML allowed. Invalid question will be ignored.'
	],
	'type'       => [
			'label' => 'Type of question:',
			'normal' => [
					'label'   => 'Normal Question'
			],
			'yesno' => [
					'label' => 'Yes/No Question',
					'yes'   => 'Yes',
					'no'    => 'No'
			],
			'images' => [
					'label'  => 'with Images',
					'place'  => 'Answers\' Image:',
					'select' => 'Select an image'
			],
			'place'   => 'Type here your answer',
			'answers' => 'Answers:',
			'add'     => 'Add Field'
	],
	'category'   => [
			'label' => 'Category:',
			'place' => 'Select a category'
	],
	'end'        => [
			'label' => 'Ending date:',
			'place' => 'Select the ending date'
	],
	'thumb'      => [
			'label' => 'Thumbnail:',
			'place' => 'Select an image',
			'p'     => 'No HTML allowed. Invalid question will be ignored.'
	],
	'button'     => 'Submit',
  'alert'      => [
      'required' => 'All fields marked with * are required!',
      'more'     => 'Answers count more than 8!',
      'less'     => 'Answers count less than 2!',
      'images'   => 'All answers need images',
      'success'  => 'Question ask process has ended successfully.',
      'edit'     => 'Question edit process has ended successfully.'
	]
];

# + Page: Details
$lang['details'] = [
		'title' => 'Edit Details',
		'first' => [
				'label' => 'First Name:',
				'place' => 'type your first name'
		],
		'last' => [
				'label' => 'Last Name:',
				'place' => 'type your family name'
		],
		'desc' => [
				'label' => 'Description:',
				'place' => 'Write a small description about yourself'
		],
		'photo' => [
				'label' => 'Profile Photo:',
				'place' => 'Select an image'
		],
		'cover' => [
				'label' => 'Cover Photo:',
				'place' => 'Select an image'
		],
		'socials' => 'Social media:',
		'button' => 'Submit',
	  'alert' => [
	      'required' => 'All fields marked with * are required!',
	      'desc'     => 'Description must be less than 50 letters!',
	      'success'  => 'Edit details process has ended successfully.'
	  ]
];

# + Page: Footer
$lang['footer'] = [
	'links'      => 'Links',
	'subscribe'  => [
			'title'  => 'Subscribe',
			'p'      => 'Subscribe to receive inspiration, ideas, and news in your inbox.',
			'place'  => 'Your Email Address',
			'button' => 'Subscribe',
			'alert'  => [
					'exist'   => 'you have already subscribed!',
					'email'   => 'Please input a valid e-mail!',
					'success' => 'Subscribe complete successfully.'
			],
	],
	'statistics' => [
		'title'     => 'Statistics',
		'users'     => '{count} Members.',
		'questions' => '{count} Questions.',
		'votes'     => '{count} Votes.',
		'comments'  => '{count} Comments.',
		'answers'   => '{count} Answers.'
	]
];

# + Page: Forget
$lang['forget'] = [
	'title'  => 'Forgotten account?',
	'email'  => 'type your username or emil',
	'button' => 'Reset',
	'alert'  => [
			'required' => 'All fields marked with * are required!',
			'email'    => 'Please input your username or email that you sign up with!',
			'success'  => 'We have sent you an email that have you reset password link.',
			'error'    => 'Error while sending you an email, please try in another time!'
	],
	'mail'   => [
			'title'   => 'Reset your password',
			'content' => ''
	]
];

# + Page: Header
$lang['header'] = [
	'search'    => 'do you want to search for something?',
	'ask'       => 'Ask a Question',
	'profile'   => 'My profile',
	'questions' => 'Manage Questions',
	'cp'        => 'Cpanel',
	'details'   => 'Edit Details',
	'password'   => 'Change Password',
	'credits'   => 'Credits',
	'logout'    => 'Logout',
	'confirm'   => 'Are sure you wanna logout?',
	'notice'   => 'Please, notice that: do not forget to complete your informations specialy your <a href="#" data-toggle="modal" data-target="#password-modal"><b>password</b></a>.',
	'noty'      => [
			'title' => 'Notifications',
			'read' => 'Read All',
			'more' => 'Show more notifications',
			'tag' => 'tag himself in',
			'vote' => 'add vote to',
			'comment' => 'add comment to',
			'follow' => 'start following you.',
	],
	'in'        => 'Sign In',
	'up'        => 'Sign Up',
	'menu' 		  => [
			'home'       => 'Home',
			'fresh'      => 'Fresh Questions',
			'popular'    => 'Popular Questions',
			'members'    => 'Members',
			'categories' => 'Categories',
			'followed'   => 'Followed Questions'
	]
];

# + Page: Login
$lang['login'] = [
	'title'    => 'Login',
	'facebook'   => 'Sign in with Facebook',
	'twitter'   => 'Sign in with Twitter',
	'google'   => 'Sign in with Google',
	'username' => 'type your username or email',
	'password' => 'type your password',
	'keep'     => 'Keep me logged in',
	'forget'   => 'Forgotten account?',
	'button'   => 'Sign In',
  'alert'    => [
    	'required'   => 'You left username or password empty!',
    	'moderat'    => 'Membership has been banned by admin, if you think this is a mistak please feel free to contact us.',
    	'activation' => 'Membership need email activation.',
    	'approve'    => 'Membership need to be approved by administration.',
      'success'    => 'You are logged in successfully, We wish you having good times.',
      'social'     => 'There is a problem with your social ID, the username you want to login with is not yours or already exist with a different social ID!',
      'error'      => 'Username or password is not available!'
  ]
];

# + Page: Members
$lang['members'] = [
	'following'      => 'Following',
	'followers'      => 'Followers',
	'questions'      => 'Questions',
	'more-questions' => 'User Questions',
	'votes'          => 'Votes',
	'comments'       => 'Comments',
	'tags'           => 'Tags',
	'follow'         => 'Follow',
	'unfollow'       => 'Unfollow',
	'pr-followers'   => "User's Followers:",
	'pr-following'   => "User's Following:",
	'pr-more-flr'    => "more followers",
	'pr-more-fln'    => "more following",
	'pg-follow'      => 'Member:',
	'pg-followers'  => 'Followers:',
	'pg-following'  => 'Following:',
  'alert'    => [
    	// 'all'      => 'All fields are required!',
    	// 'expired'  => 'You can not add a vote for this poll because it is expired in',
    	// 'trash'  => 'Question has moved to trash successfully.',
    	'fl-success' => 'User has followed successfully.',
    	'fl-own' => 'You can not follow yourself!',
    	'fl-already' => 'You have already followed this user!',
    	'fl-delete' => 'User has being unfollowed successfully.',
  ]
];

# + Page: Questions
$lang['questions'] = [
	'follow'   => 'Follow Question',
	'unfollow' => 'Unfollow Question',
	'report'   => 'Report Question',
	'edit'     => 'Edit',
	'delete'   => 'Delete',
	'by'       => 'By {user}',
	'votes'    => 'votes',
	'tags'     => 'tags',
	'replies'  => 'replies',
	'more-comments'  => 'View more comments',
	'place-comment'  => 'Write a new comment...',
	'send-comment'  => 'Send comment',
	'cancel'  => 'Cancel',
	'nouser'  => '{signup} or {signin} in order to comment.',
	'now'  => 'Just Now',
	'pg-all'  => 'Show All',
	'pg-voters'  => 'Voters:',
	'pg-votes'  => 'Votes:',
	'pg-votes-q'  => 'Question:',
	'pg-tages'  => 'Tags:',
  'share'    => [
			'title'  => 'Share',
    	'fb'     => 'Share with Facebook',
    	'tw'     => 'Share with Twitter',
    	'gp'     => 'Share with Google+',
    	'iframe' => 'Embed'
  ],
  'alert'    => [
    	'all'      => 'All fields are required!',
    	'expired'  => 'You can not add a vote for this poll because it is expired in',
    	'trash'  => 'Question has moved to trash successfully.',
    	'fl-success' => 'Question has followed successfully.',
    	'fl-own' => 'You can not follow your own questions!',
    	'fl-already' => 'You have already followed this question!',
    	'fl-delete' => 'Question has being unfollowed successfully.',
  ]
];

# + Page: Password
$lang['password'] = [
	'title'   => 'Change Password',
	'button'   => 'Submit',
	'current' => [
			'label' => 'Current Password:',
			'place' => 'Type here your current Password.',
	],
	'new' => [
			'label' => 'New Password:',
			'place' => 'Type here your new Password.',
	],
	'renew' => [
			'label' => 'Re-type new Password:',
			'place' => 'Type here again your new Password.',
	],
  'alert'    => [
    	'required' => 'All fields are required!',
    	'old'      => 'You current password is incorrect!',
    	'match'    => 'New password dosn\'t match with the repeat!',
    	'success' => 'Password has edited successfully.'
  ]
];

# + Page: Register
$lang['register'] = [
	'title' => 'Create new account',
	'facebook' => 'Sign up with Facebook',
	'twitter' => 'Sign up with Twitter',
	'google' => 'Sign up with Google',
	'username' => [
			'label' => 'Username:',
			'place' => 'type your username',
			'p'     => 'The Username is must be between 3 and 15 characters.',
			'w'     => 'Does not allow the use of symbols and numbers in the Username.'
	],
	'password' => [
			'label' => 'Password:',
			'place' => 'type your password',
			'p'     => 'Password is Must be at least 6 characters.'
	],
	're-password' => [
			'label' => 'Re-Password:',
			'place' => 'type your re-password',
			'p'     => 'Re-password is Must match with the password.'
	],
	'email' => [
			'label' => 'Email:',
			'place' => 'type your email address',
			'p'     => 'Please enter a valide email address.'
	],
	'birth' => [
			'label' => 'Birth Date',
			'day'   => 'Day',
			'month' => 'Month',
			'year'  => 'Year'
	],
	'gender' => [
			'label'  => 'Gender',
			'male'   => 'Male',
			'female' => 'Female'
	],
	'address' => [
			'label'   => 'Address',
			'country' => 'Country',
			'city'    => 'City',
			'state'   => 'State'
	],
	'button'   => 'Submit',
  'alert' => [
      'required'         => 'All fields marked with * are required!',
      'char_username'    => 'The username must contain only letters!',
      'limited_username' => 'The Username must be limited between 3 and 15 characters!',
      'exist_username'   => 'Username is already exists!',
      'limited_pass'     => 'The Password must be limited between 6 and 12 characters!',
      'repass'           => 'Re-password is Must match with the password!',
      'check_email'      => 'Please input a valid e-mail!',
      'exist_email'      => 'E-mail Address is already exists!',
      'birth'            => 'Your birth date need to be between <b>1-1-2005</b> and <b>1-1-1942</b>!',
      'success'          => 'Registration process has ended successfully.',
      'success1'         => 'Registration process has ended successfully. But, still need approved by administration.',
      'success2'         => 'Registration process has ended successfully. But, still need activate by email.',
      'error'            => 'Username or password is not available!'
  ]
];

# + Page: Report
$lang['report'] = [
	'title'  => 'Reporting for a bad question',
	'select' => [
			'label'  => 'What is this?',
			'values' => [
					1 => 'Repeated question',
					2 => 'Very bad',
					3 => 'Inappropriate content'
			]
	],
	'textarea' => [
			'label' => 'Something else?',
			'place' => 'Something else?'
	],
	'button'   => 'Send',
  'alert'    => [
    	'required' => 'All field marked with * are required!',
      'success'  => 'Report has send successfully.',
      'error'    => 'Something went wrong!'
  ]
];

# + Page: Sidebar
$lang['sidebar'] = [
	'questions'  => [
			'title' => 'Questions of the',
			'day'   => 'Day',
			'month' => 'Month',
			'year'  => 'Year'
	],
	'categories' => 'Popular categories',
	'social'     => 'Social media',
	'follow'     => [
			'title' => 'People you should follow',
			'desc' => 'Small Description',
			'votes' => 'Votes',
			'questions' => 'Questions',
			'followers' => 'Followers',
			'tagged' => 'Tagged'
	]
];

# + Page: Votes
$lang['vote'] = [
	'follow'   => 'Follow Question',
	'step'     => 'One last step need to be done',
  'alert'    => [
    	'already'  => 'You can not send a vote for a question already voted for!',
			'expired'  => 'You can not add a vote for this poll because it is expired!',
    	// 'required' => 'You left username or password empty!',
    	// 'moderat'  => 'Membership has been banned by admin, if you think this is a mistak please feel free to contact us.',
      'success'  => 'Your votte is sent successfully.',
      'error'    => 'Username or password is not available!'
  ]
];


# + Page: Alerts
$lang['alerts'] = [
	'no-data'    => 'No data found in our database!',
	'plan'       => 'You don\'t have permission for accessing to this page, you need to upgrade your plan!',
	'planvote'   => 'You cant vote for this user question because he has reach to the maximum votes per month!',
	'permission' => 'You have no permission for accessing to this page!',
	'wrong'      => 'Something went wrong!',
	'danger'     => 'Oh snap!',
	'success'    => 'Well done!',
	'warning'    => 'Warning!',
	'info'       => 'Heads up!'
];


# + Plans / Payment
$lang['plans'] = [
	"title" => "Simple Pricing for Everyone!",
	"desc"  => "Pricing built for buisenesses of all sizes. Always know what you'll pay. All plans comse with 100% money back guarane.",
	"month" => "/per month",
	"btn"   => "Get Started",
	"alert" => [
    "success" => "Your payments has been calculated!",
    "warning" => "Your already paid for this month!"
  ]
];

# + Statistics
$lang['statistics'] = [
	"title"      => "Statistics",
	"byanswers"  => "Statistics by Answer",
	"bygender"   => "Statistics by Gender",
	"byage"      => "Statistics by Age",
	"bylocation" => "Statistics by Location",
	"list"       => "List of Voters",
	"nocountry"  => "No Country",
	"visitor"    => "visitor",
	"username"   => "Username",
	"votingdate" => "Voting Date",
	"age"        => "Age",
	"gender"     => "Gender",
	"btn"        => "Download PDF",
	"alert"      => [
    "success" => "Your payments has been calculated!",
    "warning" => "Your already paid for this month!"
  ]
];

# + Payout
$lang['payout'] = [
	"title"   => "Payout",
	"stitle"  => "Your Credits {cc}",
	"points"  => "points",
	"credits" => "Credits",
	"cp"      => "How much points",
	"email"   => "Email",
	"ep"      => "Your Email",
	"need"    => "You need to reach to {cc}, to make a withdrawn.",
	"btn"     => "Send",
	"price"   => "Price",
	"status"  => "Status",
	"created" => "Created at",
	"alert"      => [
    "success" => "Your payments has been calculated!",
    "warning" => "Your already paid for this month!"
  ]
];
