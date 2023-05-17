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

$lang['rtl']      = false;
$lang['lang']     = 'tr';
$lang['close']    = 'Kapat';
$lang['loading']  = 'Yükleniyor...';
$lang['verified'] = 'Onaylanmış Hesap';
$lang['admin']    = 'Admin';




$lang['timedate']['time_second'] = "saniye";
$lang['timedate']['time_minute'] = "dakika";
$lang['timedate']['time_hour'] = "saat";
$lang['timedate']['time_day'] = "gün";
$lang['timedate']['time_week'] = "hafta";
$lang['timedate']['time_month'] = "ay";
$lang['timedate']['time_year'] = "yıl";
$lang['timedate']['time_decade'] = "10 yıl";
$lang['timedate']['time_ago'] = "önce";

# + Page: Ask
$lang['ask'] = [
	'ask_title'  => 'Yeni soru sor',
	'edit_title' => 'Soruyu düzenle',
	'question'   => [
			'label' => 'Sorunuz:',
			'place' => 'Sorunuzu yazınız',
			'p'     => 'HTML izni yok. Uygun olmayan sorularınız yayınlanmayacak.'
	],
	'type'       => [
			'label' => 'Soru Tipi:',
			'normal' => [
					'label'   => 'Çoktan Seçmeli'
			],
			'yesno' => [
					'label' => 'Evet/Hayır',
					'yes'   => 'Evet',
					'no'    => 'Hayır'
			],
			'images' => [
					'label'  => 'Resimli ',
					'place'  => 'Cevap resmi:',
					'select' => 'Resim seçiniz'
			],
			'place'   => 'Cevabınızı buraya yazınız',
			'answers' => 'Cevaplar:',
			'add'     => 'Alan Ekle'
	],
	'category'   => [
			'label' => 'Kategori:',
			'place' => 'Kategori seçiniz'
	],
	'end'        => [
			'label' => 'Bitiş tarihi:',
			'place' => 'Bitiş tarihi seçiniz'
	],
	'thumb'      => [
			'label' => 'Küçük resim:',
			'place' => 'Resim seçiniz',
			'p'     => 'HTML izni yok. Uygun olmayan sorularınız yayınlanmayacak.'
	],
	'button'     => 'Yayınla',
  'alert'      => [
      'required' => '* işaretli alanlar zorunludur!',
      'more'     => '8\'den fazla cevap seçeneği olamaz!',
      'less'     => '2\'den az cevap seçeneği olamaz!',
      'images'   => 'Tüm cevaplar için resim seçilmeli',
      'success'  => 'Sorunuz başarıyla yayınlandı.',
      'edit'     => 'Sorunuz başarıyla düzenlendi.'
	]
];

# + Page: Details
$lang['details'] = [
		'title' => 'Profil Bilgilerini Düzenle',
		'first' => [
				'label' => 'İsim:',
				'place' => 'isminizi yazın'
		],
		'last' => [
				'label' => 'Soyisim:',
				'place' => 'soyisminizi yazınız'
		],
		'desc' => [
				'label' => 'Hakkınızda:',
				'place' => 'Kısa bir açıklama yazınız'
		],
		'photo' => [
				'label' => 'Profil Fotoğrafı:',
				'place' => 'Profil Fotoğrafı Seçiniz:'
		],
		'cover' => [
				'label' => 'Kapak Fotoğrafı:',
				'place' => 'Kapak Fotoğrafı Seçiniz:'
		],
		'socials' => 'Sosyal Medya:',
		'button' => 'Kaydet',
	  'alert' => [
	      'required' => '* ile işaretli alanlar zorunludur!',
	      'desc'     => 'Açıklama 50 harften daha kısa olmalıdır!',
	      'success'  => 'Profil bilgileriniz başarıyla düzenlendi.'
	  ]
];

# + Page: Footer
$lang['footer'] = [
	'links'      => 'Linkler',
	'subscribe'  => [
			'title'  => 'E-Posta Bülten',
			'p'      => 'Pollate hakkındaki son gelişmeler,paylaşılan son anketler ve yenilikler için e-posta bültenimize kaydolabilirsiniz.',
			'place'  => 'E-Posta Adresiniz',
			'button' => 'Kaydol',
			'alert'  => [
					'exist'   => 'E-posta bültenimize zaten kayıtlısınız!',
					'email'   => 'Lütfen geçerli bir e-posta adresi giriniz!',
					'success' => 'E-posta bültenimize başarıyla kaydoldunuz.'
			],
	],
	'statistics' => [
		'title'     => 'İstatistikler',
		// 'members'   => '{count} members on pollate community.',
		// 'questions' => 'Our members contribute with {count} questions.',
		// 'votes'     => 'The questions get more than {count} votes.',
		// 'comments'  => 'More than {count} comments from our members.',
		// 'answers'   => 'The answers exceeded {count} in total questions.'
		'users'     => '{count} Üye',
		'questions' => '{count} Soru',
		'votes'     => '{count} Oy',
		'comments'  => '{count} Yorum',
		'answers'   => '{count} Cevap'
	]
];

# + Page: Forget
$lang['forget'] = [
	'title'  => 'Şifrenizi mi unuttunuz?',
	'email'  => 'kullanıcı adınızı veya e-posta adresinizi yazınız',
	'button' => 'Sıfırla',
	'alert'  => [
			'required' => '* ile işaretli alanlar zorunludur!',
			'email'    => 'Lütfen üye olduğunuz e-posta adresinizi veya kullanıcı adınızı giriniz!',
			'success'  => 'Şifrenizi sıfırlayabileceğiniz link e-posta adresinize gönderilmiştir.',
			'error'    => 'Mail gönderilirken bir hata oluştu,lütfen daha sonra tekrar deneyiniz!'
	],
	'mail'   => [
			'title'   => 'Şifrenizi sıfırlayın',
			'content' => ''
	]
];

# + Page: Header
$lang['header'] = [
	'search'    => 'Soru Ara',
	'ask'       => 'Soru Sor',
	'profile'   => 'Profilim',
	'questions' => 'Sorularım',
	'cp'        => 'Admin Panel',
	'details'   => 'Profili Düzenle',
	'password'   => 'Şifre Değiştir',
	'credits'   => 'Kredilerim',
	'logout'    => 'Çıkış Yap',
	'confirm'   => 'Çıkış yapmak istediğinize emin misiniz?',
	'notice'   => 'Lütfen bilgilerinizi,özellikle şifrenizi güncellemeyi unutmayınız!',
	'noty'      => [
			'title' => 'Bildirimler',
			'read' => 'Hepsini Oku',
			'more' => 'Daha fazla bildirim göster',
			'tag' => 'sorusunda kendisini tagledi.',
			'vote' => 'sorunuza oy verdi.',
			'comment' => 'sorusuna yorum yaptı.',
			'follow' => 'seni takip etmeye başladı.',
	],
	'in'        => 'Giriş Yap',
	'up'        => 'Üye Ol',
	'menu' 		  => [
			'home'       => 'Anasayfa',
			'fresh'      => 'En Yeni Sorular',
			'popular'    => 'Popüler Sorular',
			'members'    => 'Üyeler',
			'categories' => 'Kategoriler',
			'followed'   => 'Takip Ettiğim Sorular'
	]
];

# + Page: Login
$lang['login'] = [
	'title'    => 'Giriş Yap',
	'facebook' => 'Facebook ile Giriş Yap',
	'twitter'  => 'Twitter ile Giriş Yap',
	'google'   => 'Google ile Giriş Yap',
	'username' => 'kullanıcı adınızı veya e-posta adresinizi yazınız',
	'password' => 'şifrenizi yazınız',
	'keep'     => 'Beni Hatırla',
	'forget'   => 'Şİfrenizi mi unuttunuz?',
	'button'   => 'Giriş Yap',
  'alert'    => [
    	'required'   => 'Kullanıcı adınızı veya şifrenizi boş bıraktınız!',
    	'moderat'    => 'Üyeliğiniz iptal edilmiştir,eğer bir yanlışlık olduğunu düşünüyorsanız lütfen bizimle iletişime geçiniz.',
    	'activation' => 'Üyeliğinizin aktifleştirilmesi için e-posta onayı gereklidir.',
    	'approve'    => 'Üyeliğinizin aktifleştirilmesi için yönetici onayı gereklidir.',
      'success'    => 'Başarıyla giriş yaptınız, keyifli vakit geçirmeniz dileğiyle!',
      'social'     => 'Sosyal medya hesaplarınız ile ilgili bir sorun var. Bu sosyal medya hesabı daha önce kullanılmış olabilir ya da size ait olmayabilir!',
      'error'      => 'Seçtiğiniz kullanıcı adı veya şifre kullanılamaz!'
  ]
];

# + Page: Members
$lang['members'] = [
	'following'      => 'Takip Ettikleriniz',
	'followers'      => 'Takipçi',
	'questions'      => 'Soru',
	'more-questions' => 'Üye Soruları',
	'votes'          => 'Oy',
	'comments'       => 'Yorumlar',
	'tags'           => 'Etiketler',
	'follow'         => 'Takip Et',
	'unfollow'       => 'Takibi Bırak',
	'pr-followers'   => "Takip Ettikleri:",
	'pr-following'   => "Takipçileri:",
	'pr-more-flr'    => "Daha fazla",
	'pr-more-fln'    => "Daha fazla",
	'pg-follow'  => 'Üye:',
	'pg-followers'  => 'Takipçiler:',
	'pg-following'  => 'Takip Ettikleri:',
  'alert'    => [
    	// 'all'      => 'All fields are required!',
    	// 'expired'  => 'You can not add a vote for this poll because it is expired in',
    	// 'trash'  => 'Question has moved to trash successfully.',
    	'fl-success' => 'Üye başarıyla takip edildi!',
    	'fl-own' => 'Kendinizi takip edemezsiniz :)!',
    	'fl-already' => 'Bu üyeyi çoktan takip ediyorsunuz!',
    	'fl-delete' => 'Üyeyi takip etmeyi bıraktınız!',
  ]
];

# + Page: Questions
$lang['questions'] = [
	'follow'   => 'Soruyu Takip Et',
	'unfollow' => 'Soruyu Takip Etmeyi Bırak',
	'report'   => 'Soruyu Raporla',
	'edit'     => 'Düzenle',
	'delete'   => 'Sil',
	'by'       => '{user} tarafından',
	'votes'    => 'oy',
	'tags'     => 'takipçi',
	'replies'  => 'cevap',
	'more-comments'  => 'Daha fazla yorum gör',
	'place-comment'  => 'Yeni yorum yaz...',
	'send-comment'  => 'Yorum gönder',
	'cancel'  => 'İptal Et',
	'nouser'  => 'Yorum yapabilmek için {signup} or {signin}.',
	'now'  => 'Şimdi',
	'pg-all'  => 'Hepsini Göster',
	'pg-voters'  => 'Oy Kullananlar:',
	'pg-votes'  => 'Oylar:',
	'pg-votes-q'  => 'Soru:',
	'pg-tages'  => 'Takipçiler:',
  'share'    => [
			'title'  => 'Paylaş',
    	'fb'     => 'Facebook\'ta paylaş',
    	'tw'     => 'Twitter\'da paylaş',
    	'gp'     => 'Google+\'da paylaş',
    	'iframe' => 'Embed'
  ],
  'alert'    => [
    	'all'      => 'Tüm alanlar zorunludur!',
    	'expired'  => 'Sorunun süresi dolduğundan anketi oylayamazsınız!',
    	'trash'  => 'Soru başarıyla silindi.',
    	'fl-success' => 'Soru başarıyla takip edildi.',
    	'fl-own' => 'Kendi sorunuzu takip edemezsiniz!',
    	'fl-already' => 'Bu soruyu çoktan takip ediyorsunuz!',
    	'fl-delete' => 'Soruyu takip etmeyi bıraktınız.',
  ]
];

# + Page: Password
$lang['password'] = [
	'title'   => 'Şifrenizi Değiştirin',
	'button'   => 'Değiştir',
	'current' => [
			'label' => 'Şimdiki şifreniz:',
			'place' => 'Şimdiki şifrenizi yazınız.',
	],
	'new' => [
			'label' => 'Yeni Şifreniz:',
			'place' => 'Yeni şifrenizi yazınız.',
	],
	'renew' => [
			'label' => 'Yeni şifreniz-tekrar:',
			'place' => 'Yeni şifrenizi tekrardan yazınız.',
	],
  'alert'    => [
    	'required' => 'Tüm alanlar zorunludur!',
    	'old'      => 'Şimdiki şifreniz yanlış!',
    	'match'    => 'Yeni şifreniz tekrar ile uyuşmuyor!',
    	'success' => 'Şifrenizi başarıyla değiştirdiniz.'
  ]
];

# + Page: Register
$lang['register'] = [
	'title' => 'Yeni Üyelik',
	'facebook' => 'Facebook ile Giriş Yap',
	'twitter' => 'Twitter ile Giriş Yap',
	'google' => 'Google ile Giriş Yap',
	'username' => [
			'label' => 'Kullanıcı Adı:',
			'place' => 'kullanıcı adınızı yazınız',
			'p'     => 'Kullanıcı adınız 3 ile 15 karakter arasında olmalıdır.',
			'w'     => 'Kullanıcı adınızda sembol veya sayı kullanamazsınız.'
	],
	'password' => [
			'label' => 'Şifre',
			'place' => 'şifrenizi yazınız',
			'p'     => 'Şifreniz minimum 6 karakterden oluşmalıdır.'
	],
	're-password' => [
			'label' => 'Şifre-tekrar:',
			'place' => 'şifrenizi tekrardan yazınız',
			'p'     => 'Şifre tekrarınız şifreniz ile eşleşmelidir.'
	],
	'email' => [
			'label' => 'E-posta:',
			'place' => 'e-posta adresinizi yazınız',
			'p'     => 'Lütfen geçerli bir e-posta adresi yazınız.'
	],
	'birth' => [
			'label' => 'Doğum Tarihi',
			'day'   => 'Gün',
			'month' => 'Ay',
			'year'  => 'Yıl'
	],
	'gender' => [
			'label'  => 'Cinsiyet',
			'male'   => 'Erkek',
			'female' => 'Kadın'
	],
	'address' => [
			'label'   => 'Adres',
			'country' => 'Ülke',
			'city'    => 'Şehir',
			'state'   => 'Eyalet'
	],
	'button'   => 'Kaydol',
  'alert' => [
      'required'         => '* ile işaretli alanladr zorunldur!',
      'char_username'    => 'Kullanıcı adınız sadece harflerden oluşmalıdır!',
      'limited_username' => 'Kullanıcı adınız 3 ile 15 karakter arasında olmalıdır!',
      'exist_username'   => 'Kullanıcı adı çoktan alınmış!',
      'limited_pass'     => 'Şifreniz 6 ile 12 karakter arasında olmalıdır.!',
      'repass'           => 'Şifre tekrarınız şifreniz ile eşleşmelidir!',
      'check_email'      => 'Lütfen geçerli bir e-posta adresi giriniz!',
      'exist_email'      => 'Yazdığınız e-posta adresi çoktan kayıtlı!',
      'birth'            => 'Doğum tarihiniz <b>1-1-2005</b> and <b>1-1-1942</b>!',
      'success'          => 'Başarıyla üye oldunuz, keyifli vakit geçirmeniz dileğiyle!',
      'success1'         => 'Başarıyla üye oldunuz fakat üyeliğinizin aktifleştirilmesi için yönetici onayı gereklidir.',
      'success2'         => 'Başarıyla üye oldunuz fakat üyeliğinizin aktifleştirilmesi için e-posta onayı gereklidir.',
      'error'            => 'Seçtiğiniz kullanıcı adı veya şifre kullanılamaz!'
  ]
];

# + Page: Report
$lang['report'] = [
	'title'  => 'Soru şikayeti',
	'select' => [
			'label'  => 'Bu nedir?',
			'values' => [
					1 => 'Tekrarlanmış soru',
					2 => 'Çok kötü',
					3 => 'Uygunsuz içerik'
			]
	],
	'textarea' => [
			'label' => 'Başka?',
			'place' => 'Başka?'
	],
	'button'   => 'Gönder',
  'alert'    => [
    	'required' => '* ile işaretli alanlar zorunludur!',
      'success'  => 'Rapor başarıyla gönderildi.',
      'error'    => 'Bir sorun var!'
  ]
];

# + Page: Sidebar
$lang['sidebar'] = [
	'questions'  => [
			'title' => 'Sorusu',
			'day'   => 'Günün',
			'month' => 'Ayın',
			'year'  => 'Yılın'
	],
	'categories' => 'Popüler Kategoriler',
	'social'     => 'Sosyal Medya',
	'follow'     => [
			'title' => 'Takip Edebileceğiniz Kişiler',
			'desc' => '',
			'votes' => 'Oylar',
			'questions' => 'Sorular',
			'followers' => 'Takipçiler',
			'tagged' => 'Etiketler'
	]
];

# + Page: Votes
$lang['vote'] = [
	'follow'   => 'Soruyu Takip Et',
	'step'     => 'Bir adım daha kaldı',
  'alert'    => [
    	'already'  => 'Dana önce oyladığınız bir soru için oy kullanamazsınız!',
			'expired'  => 'Bu soru için oylama sona erdi! Bu sebeple oy kullanamazsınız!',
    	// 'required' => 'You left username or password empty!',
    	// 'moderat'  => 'Membership has been banned by admin, if you think this is a mistak please feel free to contact us.',
      'success'  => 'Oyunuz başarıyla kaydedildi!.',
      'error'    => 'Kullanıcı adı veya şifre kullanılamaz!'
  ]
];


# + Page: Alerts
$lang['alerts'] = [
	'no-data'    => 'Veritabanında herhangi bir kayıt bulunamadı!',
	'permission' => 'Bu sayfaya erişmek için yetkiniz yok!',
	'wrong'      => 'Bir sorun var!',
	'danger'     => 'Bir sorun var!',
	'success'    => 'Tebrikler!',
	'warning'    => 'Uyarı!',
	'info'       => 'Hey!'
];
