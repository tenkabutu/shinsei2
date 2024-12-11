/**
 * @preserve jQuery DateTimePicker
 * @homepage http://xdsoft.net/jqplugins/datetimepicker/
 * @author Chupurnov Valeriy (<chupurnov@gmail.com>)
 */

/**
 * @param {jQuery} $
 */
var datetimepickerFactory = function ($) {
	'use strict';

	var default_options  = {
		i18n: {
			ar: { // Arabic
				months: [
					"كانون الثاني", "شباط", "آذار", "نيسان", "مايو", "حزيران", "تموز", "آب", "أيلول", "تشرين الأول", "تشرين الثاني", "كانون الأول"
				],
				dayOfWeekShort: [
					"ن", "ث", "ع", "خ", "ج", "س", "ح"
				],
				dayOfWeek: ["الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت", "الأحد"]
			},
			ro: { // Romanian
				months: [
					"Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"
				],
				dayOfWeekShort: [
					"Du", "Lu", "Ma", "Mi", "Jo", "Vi", "Sâ"
				],
				dayOfWeek: ["Duminică", "Luni", "Marţi", "Miercuri", "Joi", "Vineri", "Sâmbătă"]
			},
			id: { // Indonesian
				months: [
					"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
				],
				dayOfWeekShort: [
					"Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"
				],
				dayOfWeek: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]
			},
			is: { // Icelandic
				months: [
					"Janúar", "Febrúar", "Mars", "Apríl", "Maí", "Júní", "Júlí", "Ágúst", "September", "Október", "Nóvember", "Desember"
				],
				dayOfWeekShort: [
					"Sun", "Mán", "Þrið", "Mið", "Fim", "Fös", "Lau"
				],
				dayOfWeek: ["Sunnudagur", "Mánudagur", "Þriðjudagur", "Miðvikudagur", "Fimmtudagur", "Föstudagur", "Laugardagur"]
			},
			bg: { // Bulgarian
				months: [
					"Януари", "Февруари", "Март", "Април", "Май", "Юни", "Юли", "Август", "Септември", "Октомври", "Ноември", "Декември"
				],
				dayOfWeekShort: [
					"Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"
				],
				dayOfWeek: ["Неделя", "Понеделник", "Вторник", "Сряда", "Четвъртък", "Петък", "Събота"]
			},
			fa: { // Persian/Farsi
				months: [
					'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'
				],
				dayOfWeekShort: [
					'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه', 'شنبه'
				],
				dayOfWeek: ["یک‌شنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه", "شنبه", "یک‌شنبه"]
			},
			ru: { // Russian
				months: [
					'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
				],
				dayOfWeekShort: [
					"Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"
				],
				dayOfWeek: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
			},
			uk: { // Ukrainian
				months: [
					'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'
				],
				dayOfWeekShort: [
					"Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"
				],
				dayOfWeek: ["Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота"]
			},
			en: { // English
				months: [
					"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
				],
				dayOfWeekShort: [
					"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
				],
				dayOfWeek: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
			},
			el: { // Ελληνικά
				months: [
					"Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάιος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"
				],
				dayOfWeekShort: [
					"Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ"
				],
				dayOfWeek: ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"]
			},
			de: { // German
				months: [
					'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
				],
				dayOfWeekShort: [
					"So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"
				],
				dayOfWeek: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"]
			},
			nl: { // Dutch
				months: [
					"januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"
				],
				dayOfWeekShort: [
					"zo", "ma", "di", "wo", "do", "vr", "za"
				],
				dayOfWeek: ["zondag", "maandag", "dinsdag", "woensdag", "donderdag", "vrijdag", "zaterdag"]
			},
			tr: { // Turkish
				months: [
					"Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"
				],
				dayOfWeekShort: [
					"Paz", "Pts", "Sal", "Çar", "Per", "Cum", "Cts"
				],
				dayOfWeek: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"]
			},
			fr: { //French
				months: [
					"Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
				],
				dayOfWeekShort: [
					"Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"
				],
				dayOfWeek: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"]
			},
			es: { // Spanish
				months: [
					"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
				],
				dayOfWeekShort: [
					"Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"
				],
				dayOfWeek: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"]
			},
			th: { // Thai
				months: [
					'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
				],
				dayOfWeekShort: [
					'อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'
				],
				dayOfWeek: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์"]
			},
			pl: { // Polish
				months: [
					"styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"
				],
				dayOfWeekShort: [
					"nd", "pn", "wt", "śr", "cz", "pt", "sb"
				],
				dayOfWeek: ["niedziela", "poniedziałek", "wtorek", "środa", "czwartek", "piątek", "sobota"]
			},
			pt: { // Portuguese
				months: [
					"Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
				],
				dayOfWeekShort: [
					"Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"
				],
				dayOfWeek: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"]
			},
			ch: { // Simplified Chinese
				months: [
					"一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"
				],
				dayOfWeekShort: [
					"日", "一", "二", "三", "四", "五", "六"
				]
			},
			se: { // Swedish
				months: [
					"Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September",  "Oktober", "November", "December"
				],
				dayOfWeekShort: [
					"Sön", "Mån", "Tis", "Ons", "Tor", "Fre", "Lör"
				]
			},
			km: { // Khmer (ភាសាខ្មែរ)
				months: [
					"មករា​", "កុម្ភៈ", "មិនា​", "មេសា​", "ឧសភា​", "មិថុនា​", "កក្កដា​", "សីហា​", "កញ្ញា​", "តុលា​", "វិច្ឆិកា", "ធ្នូ​"
				],
				dayOfWeekShort: ["អាទិ​", "ច័ន្ទ​", "អង្គារ​", "ពុធ​", "ព្រហ​​", "សុក្រ​", "សៅរ៍"],
				dayOfWeek: ["អាទិត្យ​", "ច័ន្ទ​", "អង្គារ​", "ពុធ​", "ព្រហស្បតិ៍​", "សុក្រ​", "សៅរ៍"]
			},
			kr: { // Korean
				months: [
					"1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"
				],
				dayOfWeekShort: [
					"일", "월", "화", "수", "목", "금", "토"
				],
				dayOfWeek: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"]
			},
			it: { // Italian
				months: [
					"Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"
				],
				dayOfWeekShort: [
					"Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab"
				],
				dayOfWeek: ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"]
			},
			da: { // Dansk
				months: [
					"Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December"
				],
				dayOfWeekShort: [
					"Søn", "Man", "Tir", "Ons", "Tor", "Fre", "Lør"
				],
				dayOfWeek: ["søndag", "mandag", "tirsdag", "onsdag", "torsdag", "fredag", "lørdag"]
			},
			no: { // Norwegian
				months: [
					"Januar", "Februar", "Mars", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Desember"
				],
				dayOfWeekShort: [
					"Søn", "Man", "Tir", "Ons", "Tor", "Fre", "Lør"
				],
				dayOfWeek: ['Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag']
			},
			ja: { // Japanese
				months: [
					"1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"
				],
				dayOfWeekShort: [
					"日", "月", "火", "水", "木", "金", "土"
				],
				dayOfWeek: ["日曜", "月曜", "火曜", "水曜", "木曜", "金曜", "土曜"]
			},
			vi: { // Vietnamese
				months: [
					"Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
				],
				dayOfWeekShort: [
					"CN", "T2", "T3", "T4", "T5", "T6", "T7"
				],
				dayOfWeek: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"]
			},
			sl: { // Slovenščina
				months: [
					"Januar", "Februar", "Marec", "April", "Maj", "Junij", "Julij", "Avgust", "September", "Oktober", "November", "December"
				],
				dayOfWeekShort: [
					"Ned", "Pon", "Tor", "Sre", "Čet", "Pet", "Sob"
				],
				dayOfWeek: ["Nedelja", "Ponedeljek", "Torek", "Sreda", "Četrtek", "Petek", "Sobota"]
			},
			cs: { // Čeština
				months: [
					"Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen", "Září", "Říjen", "Listopad", "Prosinec"
				],
				dayOfWeekShort: [
					"Ne", "Po", "Út", "St", "Čt", "Pá", "So"
				]
			},
			hu: { // Hungarian
				months: [
					"Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"
				],
				dayOfWeekShort: [
					"Va", "Hé", "Ke", "Sze", "Cs", "Pé", "Szo"
				],
				dayOfWeek: ["vasárnap", "hétfő", "kedd", "szerda", "csütörtök", "péntek", "szombat"]
			},
			az: { //Azerbaijanian (Azeri)
				months: [
					"Yanvar", "Fevral", "Mart", "Aprel", "May", "Iyun", "Iyul", "Avqust", "Sentyabr", "Oktyabr", "Noyabr", "Dekabr"
				],
				dayOfWeekShort: [
					"B", "Be", "Ça", "Ç", "Ca", "C", "Ş"
				],
				dayOfWeek: ["Bazar", "Bazar ertəsi", "Çərşənbə axşamı", "Çərşənbə", "Cümə axşamı", "Cümə", "Şənbə"]
			},
			bs: { //Bosanski
				months: [
					"Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"
				],
				dayOfWeekShort: [
					"Ned", "Pon", "Uto", "Sri", "Čet", "Pet", "Sub"
				],
				dayOfWeek: ["Nedjelja","Ponedjeljak", "Utorak", "Srijeda", "Četvrtak", "Petak", "Subota"]
			},
			ca: { //Català
				months: [
					"Gener", "Febrer", "Març", "Abril", "Maig", "Juny", "Juliol", "Agost", "Setembre", "Octubre", "Novembre", "Desembre"
				],
				dayOfWeekShort: [
					"Dg", "Dl", "Dt", "Dc", "Dj", "Dv", "Ds"
				],
				dayOfWeek: ["Diumenge", "Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Dissabte"]
			},
			'en-GB': { //English (British)
				months: [
					"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
				],
				dayOfWeekShort: [
					"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
				],
				dayOfWeek: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
			},
			et: { //"Eesti"
				months: [
					"Jaanuar", "Veebruar", "Märts", "Aprill", "Mai", "Juuni", "Juuli", "August", "September", "Oktoober", "November", "Detsember"
				],
				dayOfWeekShort: [
					"P", "E", "T", "K", "N", "R", "L"
				],
				dayOfWeek: ["Pühapäev", "Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede", "Laupäev"]
			},
			eu: { //Euskara
				months: [
					"Urtarrila", "Otsaila", "Martxoa", "Apirila", "Maiatza", "Ekaina", "Uztaila", "Abuztua", "Iraila", "Urria", "Azaroa", "Abendua"
				],
				dayOfWeekShort: [
					"Ig.", "Al.", "Ar.", "Az.", "Og.", "Or.", "La."
				],
				dayOfWeek: ['Igandea', 'Astelehena', 'Asteartea', 'Asteazkena', 'Osteguna', 'Ostirala', 'Larunbata']
			},
			fi: { //Finnish (Suomi)
				months: [
					"Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu", "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"
				],
				dayOfWeekShort: [
					"Su", "Ma", "Ti", "Ke", "To", "Pe", "La"
				],
				dayOfWeek: ["sunnuntai", "maanantai", "tiistai", "keskiviikko", "torstai", "perjantai", "lauantai"]
			},
			gl: { //Galego
				months: [
					"Xan", "Feb", "Maz", "Abr", "Mai", "Xun", "Xul", "Ago", "Set", "Out", "Nov", "Dec"
				],
				dayOfWeekShort: [
					"Dom", "Lun", "Mar", "Mer", "Xov", "Ven", "Sab"
				],
				dayOfWeek: ["Domingo", "Luns", "Martes", "Mércores", "Xoves", "Venres", "Sábado"]
			},
			hr: { //Hrvatski
				months: [
					"Siječanj", "Veljača", "Ožujak", "Travanj", "Svibanj", "Lipanj", "Srpanj", "Kolovoz", "Rujan", "Listopad", "Studeni", "Prosinac"
				],
				dayOfWeekShort: [
					"Ned", "Pon", "Uto", "Sri", "Čet", "Pet", "Sub"
				],
				dayOfWeek: ["Nedjelja", "Ponedjeljak", "Utorak", "Srijeda", "Četvrtak", "Petak", "Subota"]
			},
			ko: { //Korean (한국어)
				months: [
					"1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"
				],
				dayOfWeekShort: [
					"일", "월", "화", "수", "목", "금", "토"
				],
				dayOfWeek: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"]
			},
			lt: { //Lithuanian (lietuvių)
				months: [
					"Sausio", "Vasario", "Kovo", "Balandžio", "Gegužės", "Birželio", "Liepos", "Rugpjūčio", "Rugsėjo", "Spalio", "Lapkričio", "Gruodžio"
				],
				dayOfWeekShort: [
					"Sek", "Pir", "Ant", "Tre", "Ket", "Pen", "Šeš"
				],
				dayOfWeek: ["Sekmadienis", "Pirmadienis", "Antradienis", "Trečiadienis", "Ketvirtadienis", "Penktadienis", "Šeštadienis"]
			},
			lv: { //Latvian (Latviešu)
				months: [
					"Janvāris", "Februāris", "Marts", "Aprīlis ", "Maijs", "Jūnijs", "Jūlijs", "Augusts", "Septembris", "Oktobris", "Novembris", "Decembris"
				],
				dayOfWeekShort: [
					"Sv", "Pr", "Ot", "Tr", "Ct", "Pk", "St"
				],
				dayOfWeek: ["Svētdiena", "Pirmdiena", "Otrdiena", "Trešdiena", "Ceturtdiena", "Piektdiena", "Sestdiena"]
			},
			mk: { //Macedonian (Македонски)
				months: [
					"јануари", "февруари", "март", "април", "мај", "јуни", "јули", "август", "септември", "октомври", "ноември", "декември"
				],
				dayOfWeekShort: [
					"нед", "пон", "вто", "сре", "чет", "пет", "саб"
				],
				dayOfWeek: ["Недела", "Понеделник", "Вторник", "Среда", "Четврток", "Петок", "Сабота"]
			},
			mn: { //Mongolian (Монгол)
				months: [
					"1-р сар", "2-р сар", "3-р сар", "4-р сар", "5-р сар", "6-р сар", "7-р сар", "8-р сар", "9-р сар", "10-р сар", "11-р сар", "12-р сар"
				],
				dayOfWeekShort: [
					"Дав", "Мяг", "Лха", "Пүр", "Бсн", "Бям", "Ням"
				],
				dayOfWeek: ["Даваа", "Мягмар", "Лхагва", "Пүрэв", "Баасан", "Бямба", "Ням"]
			},
			'pt-BR': { //Português(Brasil)
				months: [
					"Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
				],
				dayOfWeekShort: [
					"Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"
				],
				dayOfWeek: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"]
			},
			sk: { //Slovenčina
				months: [
					"Január", "Február", "Marec", "Apríl", "Máj", "Jún", "Júl", "August", "September", "Október", "November", "December"
				],
				dayOfWeekShort: [
					"Ne", "Po", "Ut", "St", "Št", "Pi", "So"
				],
				dayOfWeek: ["Nedeľa", "Pondelok", "Utorok", "Streda", "Štvrtok", "Piatok", "Sobota"]
			},
			sq: { //Albanian (Shqip)
				months: [
					"Janar", "Shkurt", "Mars", "Prill", "Maj", "Qershor", "Korrik", "Gusht", "Shtator", "Tetor", "Nëntor", "Dhjetor"
				],
				dayOfWeekShort: [
					"Die", "Hën", "Mar", "Mër", "Enj", "Pre", "Shtu"
				],
				dayOfWeek: ["E Diel", "E Hënë", "E Martē", "E Mërkurë", "E Enjte", "E Premte", "E Shtunë"]
			},
			'sr-YU': { //Serbian (Srpski)
				months: [
					"Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"
				],
				dayOfWeekShort: [
					"Ned", "Pon", "Uto", "Sre", "čet", "Pet", "Sub"
				],
				dayOfWeek: ["Nedelja","Ponedeljak", "Utorak", "Sreda", "Četvrtak", "Petak", "Subota"]
			},
			sr: { //Serbian Cyrillic (Српски)
				months: [
					"јануар", "фебруар", "март", "април", "мај", "јун", "јул", "август", "септембар", "октобар", "новембар", "децембар"
				],
				dayOfWeekShort: [
					"нед", "пон", "уто", "сре", "чет", "пет", "суб"
				],
				dayOfWeek: ["Недеља","Понедељак", "Уторак", "Среда", "Четвртак", "Петак", "Субота"]
			},
			sv: { //Svenska
				months: [
					"Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December"
				],
				dayOfWeekShort: [
					"Sön", "Mån", "Tis", "Ons", "Tor", "Fre", "Lör"
				],
				dayOfWeek: ["Söndag", "Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag"]
			},
			'zh-TW': { //Traditional Chinese (繁體中文)
				months: [
					"一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"
				],
				dayOfWeekShort: [
					"日", "一", "二", "三", "四", "五", "六"
				],
				dayOfWeek: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"]
			},
			zh: { //Simplified Chinese (简体中文)
				months: [
					"一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"
				],
				dayOfWeekShort: [
					"日", "一", "二", "三", "四", "五", "六"
				],
				dayOfWeek: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"]
			},
			ug:{ // Uyghur(ئۇيغۇرچە)
				months: [
					"1-ئاي","2-ئاي","3-ئاي","4-ئاي","5-ئاي","6-ئاي","7-ئاي","8-ئاي","9-ئاي","10-ئاي","11-ئاي","12-ئاي"
				],
				dayOfWeek: [
					"يەكشەنبە", "دۈشەنبە","سەيشەنبە","چارشەنبە","پەيشەنبە","جۈمە","شەنبە"
				]
			},
			he: { //Hebrew (עברית)
				months: [
					'ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'
				],
				dayOfWeekShort: [
					'א\'', 'ב\'', 'ג\'', 'ד\'', 'ה\'', 'ו\'', 'שבת'
				],
				dayOfWeek: ["ראשון", "שני", "שלישי", "רביעי", "חמישי", "שישי", "שבת", "ראשון"]
			},
			hy: { // Armenian
				months: [
					"Հունվար", "Փետրվար", "Մարտ", "Ապրիլ", "Մայիս", "Հունիս", "Հուլիս", "Օգոստոս", "Սեպտեմբեր", "Հոկտեմբեր", "Նոյեմբեր", "Դեկտեմբեր"
				],
				dayOfWeekShort: [
					"Կի", "Երկ", "Երք", "Չոր", "Հնգ", "Ուրբ", "Շբթ"
				],
				dayOfWeek: ["Կիրակի", "Երկուշաբթի", "Երեքշաբթի", "Չորեքշաբթի", "Հինգշաբթի", "Ուրբաթ", "Շաբաթ"]
			},
			kg: { // Kyrgyz
				months: [
					'Үчтүн айы', 'Бирдин айы', 'Жалган Куран', 'Чын Куран', 'Бугу', 'Кулжа', 'Теке', 'Баш Оона', 'Аяк Оона', 'Тогуздун айы', 'Жетинин айы', 'Бештин айы'
				],
				dayOfWeekShort: [
					"Жек", "Дүй", "Шей", "Шар", "Бей", "Жум", "Ише"
				],
				dayOfWeek: [
					"Жекшемб", "Дүйшөмб", "Шейшемб", "Шаршемб", "Бейшемби", "Жума", "Ишенб"
				]
			},
			rm: { // Romansh
				months: [
					"Schaner", "Favrer", "Mars", "Avrigl", "Matg", "Zercladur", "Fanadur", "Avust", "Settember", "October", "November", "December"
				],
				dayOfWeekShort: [
					"Du", "Gli", "Ma", "Me", "Gie", "Ve", "So"
				],
				dayOfWeek: [
					"Dumengia", "Glindesdi", "Mardi", "Mesemna", "Gievgia", "Venderdi", "Sonda"
				]
			},
			ka: { // Georgian
				months: [
					'იანვარი', 'თებერვალი', 'მარტი', 'აპრილი', 'მაისი', 'ივნისი', 'ივლისი', 'აგვისტო', 'სექტემბერი', 'ოქტომბერი', 'ნოემბერი', 'დეკემბერი'
				],
				dayOfWeekShort: [
					"კვ", "ორშ", "სამშ", "ოთხ", "ხუთ", "პარ", "შაბ"
				],
				dayOfWeek: ["კვირა", "ორშაბათი", "სამშაბათი", "ოთხშაბათი", "ხუთშაბათი", "პარასკევი", "შაბათი"]
			},
			kk: { // Kazakh
				months: [
					'Қаңтар', 'Ақпан', 'Наурыз', 'Сәуір', 'Мамыр', 'Маусым', 'Шілде', 'Тамыз', 'Қыркүйек', 'Қазан', 'Қараша', 'Желтоқсан'
				],
				dayOfWeekShort: [
					"Жк", "Дс", "Сс", "Ср", "Бс", "Жм", "Сб"
				],
				dayOfWeek: ["Жексенбі", "Дүйсенбі", "Сейсенбі", "Сәрсенбі", "Бейсенбі", "Жұма", "Сенбі"]
			}
		},

		ownerDocument: document,
		contentWindow: window,

		value: '',
		rtl: false,

		format:	'Y/m/d H:i',
		formatTime:	'H:i',
		formatDate:	'Y/m/d',

		startDate:	false, // new Date(), '1986/12/08', '-1970/01/05','-1970/01/05',
		step: 60,
		monthChangeSpinner: true,

		closeOnDateSelect: false,
		closeOnTimeSelect: true,
		closeOnWithoutClick: true,
		closeOnInputClick: true,
		openOnFocus: true,

		timepicker: true,
		datepicker: true,
		weeks: false,

		defaultTime: false,	// use formatTime format (ex. '10:00' for formatTime:	'H:i')
		defaultDate: false,	// use formatDate format (ex new Date() or '1986/12/08' or '-1970/01/05' or '-1970/01/05')

		minDate: false,
		maxDate: false,
		minTime: false,
		maxTime: false,
		minDateTime: false,
		maxDateTime: false,

		allowTimes: [],
		opened: false,
		initTime: true,
		inline: false,
		theme: '',
		touchMovedThreshold: 5,

		onSelectDate: function () {},
		onSelectTime: function () {},
		onChangeMonth: function () {},
		onGetWeekOfYear: function () {},
		onChangeYear: function () {},
		onChangeDateTime: function () {},
		onShow: function () {},
		onClose: function () {},
		onGenerate: function () {},

		withoutCopyright: true,
		inverseButton: false,
		hours12: false,
		next: 'xdsoft_next',
		prev : 'xdsoft_prev',
		dayOfWeekStart: 0,
		parentID: 'body',
		timeHeightInTimePicker: 25,
		timepickerScrollbar: true,
		todayButton: true,
		prevButton: true,
		nextButton: true,
		defaultSelect: true,

		scrollMonth: true,
		scrollTime: true,
		scrollInput: true,

		lazyInit: false,
		mask: false,
		validateOnBlur: true,
		allowBlank: true,
		yearStart: 1950,
		yearEnd: 2050,
		monthStart: 0,
		monthEnd: 11,
		style: '',
		id: '',
		fixed: false,
		roundTime: 'round', // ceil, floor
		className: '',
		weekends: [],
		highlightedDates: [],
		highlightedPeriods: [],
		allowDates : [],
		allowDateRe : null,
		disabledDates : [],
		disabledWeekDays: [],
		yearOffset: 0,
		beforeShowDay: null,

		enterLikeTab: true,
        showApplyButton: false,
        insideParent: false,
	};

	var dateHelper = null,
		defaultDateHelper = null,
		globalLocaleDefault = 'en',
		globalLocale = 'en';

	var dateFormatterOptionsDefault = {
		meridiem: ['AM', 'PM']
	};

	var initDateFormatter = function(){
		var locale = default_options.i18n[globalLocale],
			opts = {
				days: locale.dayOfWeek,
				daysShort: locale.dayOfWeekShort,
				months: locale.months,
				monthsShort: $.map(locale.months, function(n){ return n.substring(0, 3) })
			};

		if (typeof DateFormatter === 'function') {
			dateHelper = defaultDateHelper = new DateFormatter({
				dateSettings: $.extend({}, dateFormatterOptionsDefault, opts)
			});
		}
	};

	var dateFormatters = {
		moment: {
			default_options:{
				format: 'YYYY/MM/DD HH:mm',
				formatDate: 'YYYY/MM/DD',
				formatTime: 'HH:mm',
			},
			formatter: {
				parseDate: function (date, format) {
					if(isFormatStandard(format)){
						return defaultDateHelper.parseDate(date, format);
					}
					var d = moment(date, format);
					return d.isValid() ? d.toDate() : false;
				},

				formatDate: function (date, format) {
					if(isFormatStandard(format)){
						return defaultDateHelper.formatDate(date, format);
					}
					return moment(date).format(format);
				},

				formatMask: function(format){
					return format
						.replace(/Y{4}/g, '9999')
						.replace(/Y{2}/g, '99')
						.replace(/M{2}/g, '19')
						.replace(/D{2}/g, '39')
						.replace(/H{2}/g, '29')
						.replace(/m{2}/g, '59')
						.replace(/s{2}/g, '59');
				},
			}
		}
	}

	// for locale settings
	$.datetimepicker = {
		setLocale: function(locale){
			var newLocale = default_options.i18n[locale] ? locale : globalLocaleDefault;
			if (globalLocale !== newLocale) {
				globalLocale = newLocale;
				// reinit date formatter
				initDateFormatter();
			}
		},

		setDateFormatter: function(dateFormatter) {
			if(typeof dateFormatter === 'string' && dateFormatters.hasOwnProperty(dateFormatter)){
				var df = dateFormatters[dateFormatter];
				$.extend(default_options, df.default_options);
				dateHelper = df.formatter;
			}
			else {
				dateHelper = dateFormatter;
			}
		},
	};

	var standardFormats = {
		RFC_2822: 'D, d M Y H:i:s O',
		ATOM: 'Y-m-d\TH:i:sP',
		ISO_8601: 'Y-m-d\TH:i:sO',
		RFC_822: 'D, d M y H:i:s O',
		RFC_850: 'l, d-M-y H:i:s T',
		RFC_1036: 'D, d M y H:i:s O',
		RFC_1123: 'D, d M Y H:i:s O',
		RSS: 'D, d M Y H:i:s O',
		W3C: 'Y-m-d\TH:i:sP'
	}

	var isFormatStandard = function(format){
		return Object.values(standardFormats).indexOf(format) === -1 ? false : true;
	}

	$.extend($.datetimepicker, standardFormats);

	// first init date formatter
	initDateFormatter();

	// fix for ie8
	if (!window.getComputedStyle) {
		window.getComputedStyle = function (el) {
			this.el = el;
			this.getPropertyValue = function (prop) {
				var re = /(-([a-z]))/g;
				if (prop === 'float') {
					prop = 'styleFloat';
				}
				if (re.test(prop)) {
					prop = prop.replace(re, function (a, b, c) {
						return c.toUpperCase();
					});
				}
				return el.currentStyle[prop] || null;
			};
			return this;
		};
	}
	if (!Array.prototype.indexOf) {
		Array.prototype.indexOf = function (obj, start) {
			var i, j;
			for (i = (start || 0), j = this.length; i < j; i += 1) {
				if (this[i] === obj) { return i; }
			}
			return -1;
		};
	}

	Date.prototype.countDaysInMonth = function () {
		return new Date(this.getFullYear(), this.getMonth() + 1, 0).getDate();
	};

	$.fn.xdsoftScroller = function (options, percent) {
		return this.each(function () {
			var timeboxparent = $(this),
				pointerEventToXY = function (e) {
					var out = {x: 0, y: 0},
						touch;
					if (e.type === 'touchstart' || e.type === 'touchmove' || e.type === 'touchend' || e.type === 'touchcancel') {
						touch  = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
						out.x = touch.clientX;
						out.y = touch.clientY;
					} else if (e.type === 'mousedown' || e.type === 'mouseup' || e.type === 'mousemove' || e.type === 'mouseover' || e.type === 'mouseout' || e.type === 'mouseenter' || e.type === 'mouseleave') {
						out.x = e.clientX;
						out.y = e.clientY;
					}
					return out;
				},
				getWheelDelta = function (e) {
					var deltaY = 0;

					if ('detail' in e) { deltaY = e.detail; }
					if ('wheelDelta' in e) { deltaY = -e.wheelDelta / 120; }
					if ('wheelDeltaY' in e) { deltaY = -e.wheelDeltaY / 120; }
					if ('axis' in e && e.axis === e.HORIZONTAL_AXIS) { deltaY = 0; }

					deltaY *= 10;

					if ('deltaY' in e) { deltaY = -e.deltaY; }

					if (deltaY && e.deltaMode) {
						if (e.deltaMode === 1) {
							deltaY *= 40;
						} else {
							deltaY *= 800;
						}
					}

					return deltaY;
				},
				timebox,
				timeboxTop = 0,
				parentHeight,
				height,
				scrollbar,
				scroller,
				maximumOffset = 100,
				start = false,
				startY = 0,
				startTop = 0,
				h1 = 0,
				touchStart = false,
				startTopScroll = 0,
				calcOffset = function () {};

			if (percent === 'hide') {
				timeboxparent.find('.xdsoft_scrollbar').hide();
				return;
			}

			if (!$(this).hasClass('xdsoft_scroller_box')) {
				timebox = timeboxparent.children().eq(0);
				timeboxTop = Math.abs(parseInt(timebox.css('marginTop'), 10));
				parentHeight = timeboxparent[0].clientHeight;
				height = timebox[0].offsetHeight;
				scrollbar = $('<div class="xdsoft_scrollbar"></div>');
				scroller = $('<div class="xdsoft_scroller"></div>');
				scrollbar.append(scroller);

				timeboxparent.addClass('xdsoft_scroller_box').append(scrollbar);
				calcOffset = function calcOffset(event) {
					var offset = pointerEventToXY(event).y - startY + startTopScroll;
					if (offset < 0) {
						offset = 0;
					}
					if (offset + scroller[0].offsetHeight > h1) {
						offset = h1 - scroller[0].offsetHeight;
					}
					timeboxparent.trigger('scroll_element.xdsoft_scroller', [maximumOffset ? offset / maximumOffset : 0]);
				};

				scroller
					.on('touchstart.xdsoft_scroller mousedown.xdsoft_scroller', function (event) {
						if (!parentHeight) {
							timeboxparent.trigger('resize_scroll.xdsoft_scroller', [percent]);
						}

						startY = pointerEventToXY(event).y;
						startTopScroll = parseInt(scroller.css('marginTop'), 10);
						h1 = scrollbar[0].offsetHeight;

						if (event.type === 'mousedown' || event.type === 'touchstart') {
							if (options.ownerDocument) {
								$(options.ownerDocument.body).addClass('xdsoft_noselect');
							}
							$([options.ownerDocument.body, options.contentWindow]).on('touchend mouseup.xdsoft_scroller', function arguments_callee() {
								$([options.ownerDocument.body, options.contentWindow]).off('touchend mouseup.xdsoft_scroller', arguments_callee)
									.off('mousemove.xdsoft_scroller', calcOffset)
									.removeClass('xdsoft_noselect');
							});
							$(options.ownerDocument.body).on('mousemove.xdsoft_scroller', calcOffset);
						} else {
							touchStart = true;
							event.stopPropagation();
							event.preventDefault();
						}
					})
					.on('touchmove', function (event) {
						if (touchStart) {
							event.preventDefault();
							calcOffset(event);
						}
					})
					.on('touchend touchcancel', function () {
						touchStart =  false;
						startTopScroll = 0;
					});

				timeboxparent
					.on('scroll_element.xdsoft_scroller', function (event, percentage) {
						if (!parentHeight) {
							timeboxparent.trigger('resize_scroll.xdsoft_scroller', [percentage, true]);
						}
						percentage = percentage > 1 ? 1 : (percentage < 0 || isNaN(percentage)) ? 0 : percentage;
						timeboxTop = parseFloat(Math.abs((timebox[0].offsetHeight - parentHeight) * percentage).toFixed(4));

						scroller.css('marginTop', maximumOffset * percentage);
						timebox.css('marginTop', -timeboxTop);
					})
					.on('resize_scroll.xdsoft_scroller', function (event, percentage, noTriggerScroll) {
						var percent, sh;
						parentHeight = timeboxparent[0].clientHeight;
						height = timebox[0].offsetHeight;
						percent = parentHeight / height;
						sh = percent * scrollbar[0].offsetHeight;
						if (percent > 1) {
							scroller.hide();
						} else {
							scroller.show();
							scroller.css('height', parseInt(sh > 10 ? sh : 10, 10));
							maximumOffset = scrollbar[0].offsetHeight - scroller[0].offsetHeight;
							if (noTriggerScroll !== true) {
								timeboxparent.trigger('scroll_element.xdsoft_scroller', [percentage || timeboxTop / (height - parentHeight)]);
							}
						}
					});

				timeboxparent.on('mousewheel', function (event) {
					var deltaY = getWheelDelta(event.originalEvent);
					var top = Math.max(0, timeboxTop - deltaY);
					timeboxparent.trigger('scroll_element.xdsoft_scroller', [top / (height - parentHeight)]);
					event.stopPropagation();
					return false;
				});

				timeboxparent.on('touchstart', function (event) {
					start = pointerEventToXY(event);
					startTop = timeboxTop;
				});

				timeboxparent.on('touchmove', function (event) {
					if (start) {
						event.preventDefault();
						var coord = pointerEventToXY(event);
						timeboxparent.trigger('scroll_element.xdsoft_scroller', [(startTop - (coord.y - start.y)) / (height - parentHeight)]);
					}
				});

				timeboxparent.on('touchend touchcancel', function () {
					start = false;
					startTop = 0;
				});
			}
			timeboxparent.trigger('resize_scroll.xdsoft_scroller', [percent]);
		});
	};

	$.fn.datetimepicker = function (opt, opt2) {
		var result = this,
			KEY0 = 48,
			KEY9 = 57,
			_KEY0 = 96,
			_KEY9 = 105,
            CTRLKEY = 17,
            CMDKEY = 91,
			DEL = 46,
			ENTER = 13,
			ESC = 27,
			BACKSPACE = 8,
			ARROWLEFT = 37,
			ARROWUP = 38,
			ARROWRIGHT = 39,
			ARROWDOWN = 40,
			TAB = 9,
			F5 = 116,
			AKEY = 65,
			CKEY = 67,
			VKEY = 86,
			ZKEY = 90,
			YKEY = 89,
            ctrlDown	=	false,
            cmdDown = false,
			options = ($.isPlainObject(opt) || !opt) ? $.extend(true, {}, default_options, opt) : $.extend(true, {}, default_options),

			lazyInitTimer = 0,
			createDateTimePicker,
			destroyDateTimePicker,

			lazyInit = function (input) {
				input
					.on('open.xdsoft focusin.xdsoft mousedown.xdsoft touchstart', function initOnActionCallback() {
						if (input.is(':disabled') || input.data('xdsoft_datetimepicker')) {
							return;
						}
						clearTimeout(lazyInitTimer);
						lazyInitTimer = setTimeout(function () {

							if (!input.data('xdsoft_datetimepicker')) {
								createDateTimePicker(input);
							}
							input
								.off('open.xdsoft focusin.xdsoft mousedown.xdsoft touchstart', initOnActionCallback)
								.trigger('open.xdsoft');
						}, 100);
					});
			};

		createDateTimePicker = function (input) {
			var datetimepicker = $('<div class="xdsoft_datetimepicker xdsoft_noselect"></div>'),
				xdsoft_copyright = $('<div class="xdsoft_copyright"><a target="_blank" href="http://xdsoft.net/jqplugins/datetimepicker/">xdsoft.net</a></div>'),
				datepicker = $('<div class="xdsoft_datepicker active"></div>'),
				month_picker = $('<div class="xdsoft_monthpicker"><button type="button" class="xdsoft_prev"></button><button type="button" class="xdsoft_today_button"></button>' +
					'<div class="xdsoft_label xdsoft_month"><span></span><i></i></div>' +
					'<div class="xdsoft_label xdsoft_year"><span></span><i></i></div>' +
					'<button type="button" class="xdsoft_next"></button></div>'),
				calendar = $('<div class="xdsoft_calendar"></div>'),
				timepicker = $('<div class="xdsoft_timepicker active"><button type="button" class="xdsoft_prev"></button><div class="xdsoft_time_box"></div><button type="button" class="xdsoft_next"></button></div>'),
				timeboxparent = timepicker.find('.xdsoft_time_box').eq(0),
				timebox = $('<div class="xdsoft_time_variant"></div>'),
				applyButton = $('<button type="button" class="xdsoft_save_selected blue-gradient-button">Save Selected</button>'),

				monthselect = $('<div class="xdsoft_select xdsoft_monthselect"><div></div></div>'),
				yearselect = $('<div class="xdsoft_select xdsoft_yearselect"><div></div></div>'),
				triggerAfterOpen = false,
				XDSoft_datetime,

				xchangeTimer,
				timerclick,
				current_time_index,
				setPos,
				timer = 0,
				_xdsoft_datetime,
				forEachAncestorOf;

			if (options.id) {
				datetimepicker.attr('id', options.id);
			}
			if (options.style) {
				datetimepicker.attr('style', options.style);
			}
			if (options.weeks) {
				datetimepicker.addClass('xdsoft_showweeks');
			}
			if (options.rtl) {
				datetimepicker.addClass('xdsoft_rtl');
			}

			datetimepicker.addClass('xdsoft_' + options.theme);
			datetimepicker.addClass(options.className);

			month_picker
				.find('.xdsoft_month span')
				.after(monthselect);
			month_picker
				.find('.xdsoft_year span')
				.after(yearselect);

			month_picker
				.find('.xdsoft_month,.xdsoft_year')
				.on('touchstart mousedown.xdsoft', function (event) {
					var select = $(this).find('.xdsoft_select').eq(0),
						val = 0,
						top = 0,
						visible = select.is(':visible'),
						items,
						i;

					month_picker
						.find('.xdsoft_select')
						.hide();
					if (_xdsoft_datetime.currentTime) {
						val = _xdsoft_datetime.currentTime[$(this).hasClass('xdsoft_month') ? 'getMonth' : 'getFullYear']();
					}

					select[visible ? 'hide' : 'show']();
					for (items = select.find('div.xdsoft_option'), i = 0; i < items.length; i += 1) {
						if (items.eq(i).data('value') === val) {
							break;
						} else {
							top += items[0].offsetHeight;
						}
					}

					select.xdsoftScroller(options, top / (select.children()[0].offsetHeight - (select[0].clientHeight)));
					event.stopPropagation();
					return false;
				});

			var handleTouchMoved = function (event) {
				var evt = event.originalEvent;
				var touchPosition = evt.touches ? evt.touches[0] : evt;
				this.touchStartPosition = this.touchStartPosition || touchPosition;
				var xMovement = Math.abs(this.touchStartPosition.clientX - touchPosition.clientX);
				var yMovement = Math.abs(this.touchStartPosition.clientY - touchPosition.clientY);
				var distance = Math.sqrt(xMovement * xMovement + yMovement * yMovement);
				if(distance > options.touchMovedThreshold) {
					this.touchMoved = true;
				}
			}

			month_picker
				.find('.xdsoft_select')
				.xdsoftScroller(options)
				.on('touchstart mousedown.xdsoft', function (event) {
					var evt = event.originalEvent;
					this.touchMoved = false;
					this.touchStartPosition = evt.touches ? evt.touches[0] : evt;
					event.stopPropagation();
					event.preventDefault();
				})
				.on('touchmove', '.xdsoft_option', handleTouchMoved)
				.on('touchend mousedown.xdsoft', '.xdsoft_option', function () {
					if (!this.touchMoved) {
						if (_xdsoft_datetime.currentTime === undefined || _xdsoft_datetime.currentTime === null) {
							_xdsoft_datetime.currentTime = _xdsoft_datetime.now();
						}

						var year = _xdsoft_datetime.currentTime.getFullYear();
						if (_xdsoft_datetime && _xdsoft_datetime.currentTime) {
							_xdsoft_datetime.currentTime[$(this).parent().parent().hasClass('xdsoft_monthselect') ? 'setMonth' : 'setFullYear']($(this).data('value'));
						}

						$(this).parent().parent().hide();

						datetimepicker.trigger('xchange.xdsoft');
						if (options.onChangeMonth && typeof options.onChangeMonth === 'function') {
							options.onChangeMonth.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'));
						}

						if (year !== _xdsoft_datetime.currentTime.getFullYear() && typeof options.onChangeYear === 'function') {
							options.onChangeYear.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'));
						}
					}
				});

			datetimepicker.getValue = function () {
				return _xdsoft_datetime.getCurrentTime();
			};

			datetimepicker.setOptions = function (_options) {
				var highlightedDates = {};

				options = $.extend(true, {}, options, _options);

				if (_options.allowTimes && Array.isArray(_options.allowTimes) && _options.allowTimes.length) {
					options.allowTimes = $.extend(true, [], _options.allowTimes);
				}

				if (_options.weekends && Array.isArray(_options.weekends) && _options.weekends.length) {
					options.weekends = $.extend(true, [], _options.weekends);
				}

				if (_options.allowDates && Array.isArray(_options.allowDates) && _options.allowDates.length) {
					options.allowDates = $.extend(true, [], _options.allowDates);
				}

				if (_options.allowDateRe && Object.prototype.toString.call(_options.allowDateRe)==="[object String]") {
					options.allowDateRe = new RegExp(_options.allowDateRe);
				}

				if (_options.highlightedDates && Array.isArray(_options.highlightedDates) && _options.highlightedDates.length) {
					$.each(_options.highlightedDates, function (index, value) {
						var splitData = $.map(value.split(','), $.trim),
							exDesc,
							hDate = new HighlightedDate(dateHelper.parseDate(splitData[0], options.formatDate), splitData[1], splitData[2]), // date, desc, style
							keyDate = dateHelper.formatDate(hDate.date, options.formatDate);
						if (highlightedDates[keyDate] !== undefined) {
							exDesc = highlightedDates[keyDate].desc;
							if (exDesc && exDesc.length && hDate.desc && hDate.desc.length) {
								highlightedDates[keyDate].desc = exDesc + "\n" + hDate.desc;
							}
						} else {
							highlightedDates[keyDate] = hDate;
						}
					});

					options.highlightedDates = $.extend(true, [], highlightedDates);
				}

				if (_options.highlightedPeriods && Array.isArray(_options.highlightedPeriods) && _options.highlightedPeriods.length) {
					highlightedDates = $.extend(true, [], options.highlightedDates);
					$.each(_options.highlightedPeriods, function (index, value) {
						var dateTest, // start date
							dateEnd,
							desc,
							hDate,
							keyDate,
							exDesc,
							style;
						if (Array.isArray(value)) {
							dateTest = value[0];
							dateEnd = value[1];
							desc = value[2];
							style = value[3];
						}
						else {
							var splitData = $.map(value.split(','), $.trim);
							dateTest = dateHelper.parseDate(splitData[0], options.formatDate);
							dateEnd = dateHelper.parseDate(splitData[1], options.formatDate);
							desc = splitData[2];
							style = splitData[3];
						}

						while (dateTest <= dateEnd) {
							hDate = new HighlightedDate(dateTest, desc, style);
							keyDate = dateHelper.formatDate(dateTest, options.formatDate);
							dateTest.setDate(dateTest.getDate() + 1);
							if (highlightedDates[keyDate] !== undefined) {
								exDesc = highlightedDates[keyDate].desc;
								if (exDesc && exDesc.length && hDate.desc && hDate.desc.length) {
									highlightedDates[keyDate].desc = exDesc + "\n" + hDate.desc;
								}
							} else {
								highlightedDates[keyDate] = hDate;
							}
						}
					});

					options.highlightedDates = $.extend(true, [], highlightedDates);
				}

				if (_options.disabledDates && Array.isArray(_options.disabledDates) && _options.disabledDates.length) {
					options.disabledDates = $.extend(true, [], _options.disabledDates);
				}

				if (_options.disabledWeekDays && Array.isArray(_options.disabledWeekDays) && _options.disabledWeekDays.length) {
					options.disabledWeekDays = $.extend(true, [], _options.disabledWeekDays);
				}

				if ((options.open || options.opened) && (!options.inline)) {
					input.trigger('open.xdsoft');
				}

				if (options.inline) {
					triggerAfterOpen = true;
					datetimepicker.addClass('xdsoft_inline');
					input.after(datetimepicker).hide();
				}

				if (options.inverseButton) {
					options.next = 'xdsoft_prev';
					options.prev = 'xdsoft_next';
				}

				if (options.datepicker) {
					datepicker.addClass('active');
				} else {
					datepicker.removeClass('active');
				}

				if (options.timepicker) {
					timepicker.addClass('active');
				} else {
					timepicker.removeClass('active');
				}

				if (options.value) {
					_xdsoft_datetime.setCurrentTime(options.value);
					if (input && input.val) {
						input.val(_xdsoft_datetime.str);
					}
				}

				if (isNaN(options.dayOfWeekStart)) {
					options.dayOfWeekStart = 0;
				} else {
					options.dayOfWeekStart = parseInt(options.dayOfWeekStart, 10) % 7;
				}

				if (!options.timepickerScrollbar) {
					timeboxparent.xdsoftScroller(options, 'hide');
				}

				if (options.minDate && /^[\+\-](.*)$/.test(options.minDate)) {
					options.minDate = dateHelper.formatDate(_xdsoft_datetime.strToDateTime(options.minDate), options.formatDate);
				}

				if (options.maxDate &&  /^[\+\-](.*)$/.test(options.maxDate)) {
					options.maxDate = dateHelper.formatDate(_xdsoft_datetime.strToDateTime(options.maxDate), options.formatDate);
				}

                if (options.minDateTime &&  /^\+(.*)$/.test(options.minDateTime)) {
                	options.minDateTime = _xdsoft_datetime.strToDateTime(options.minDateTime).dateFormat(options.formatDate);
                }

                if (options.maxDateTime &&  /^\+(.*)$/.test(options.maxDateTime)) {
                	options.maxDateTime = _xdsoft_datetime.strToDateTime(options.maxDateTime).dateFormat(options.formatDate);
                }

				applyButton.toggle(options.showApplyButton);

				month_picker
					.find('.xdsoft_today_button')
					.css('visibility', !options.todayButton ? 'hidden' : 'visible');

				month_picker
					.find('.' + options.prev)
					.css('visibility', !options.prevButton ? 'hidden' : 'visible');

				month_picker
					.find('.' + options.next)
					.css('visibility', !options.nextButton ? 'hidden' : 'visible');

				setMask(options);

				if (options.validateOnBlur) {
					input
						.off('blur.xdsoft')
						.on('blur.xdsoft', function () {
							if (options.allowBlank && (!$(this).val().trim().length ||
									(typeof options.mask === "string" && $(this).val().trim() === options.mask.replace(/[0-9]/g, '_')))) {
								$(this).val(null);
								datetimepicker.data('xdsoft_datetime').empty();
							} else {
								var d = dateHelper.parseDate($(this).val(), options.format);
								if (d) { // parseDate() may skip some invalid parts like date or time, so make it clear for user: show parsed date/time
									$(this).val(dateHelper.formatDate(d, options.format));
								} else {
									var splittedHours   = +([$(this).val()[0], $(this).val()[1]].join('')),
										splittedMinutes = +([$(this).val()[2], $(this).val()[3]].join(''));

									// parse the numbers as 0312 => 03:12
									if (!options.datepicker && options.timepicker && splittedHours >= 0 && splittedHours < 24 && splittedMinutes >= 0 && splittedMinutes < 60) {
										$(this).val([splittedHours, splittedMinutes].map(function (item) {
											return item > 9 ? item : '0' + item;
										}).join(':'));
									} else {
										$(this).val(dateHelper.formatDate(_xdsoft_datetime.now(), options.format));
									}
								}
								datetimepicker.data('xdsoft_datetime').setCurrentTime($(this).val());
							}

							datetimepicker.trigger('changedatetime.xdsoft');
							datetimepicker.trigger('close.xdsoft');
						});
				}
				options.dayOfWeekStartPrev = (options.dayOfWeekStart === 0) ? 6 : options.dayOfWeekStart - 1;

				datetimepicker
					.trigger('xchange.xdsoft')
					.trigger('afterOpen.xdsoft');
			};

			datetimepicker
				.data('options', options)
				.on('touchstart mousedown.xdsoft', function (event) {
					event.stopPropagation();
					event.preventDefault();
					yearselect.hide();
					monthselect.hide();
					return false;
				});

			//scroll_element = timepicker.find('.xdsoft_time_box');
			timeboxparent.append(timebox);
			timeboxparent.xdsoftScroller(options);

			datetimepicker.on('afterOpen.xdsoft', function () {
				timeboxparent.xdsoftScroller(options);
			});

			datetimepicker
				.append(datepicker)
				.append(timepicker);

			if (options.withoutCopyright !== true) {
				datetimepicker
					.append(xdsoft_copyright);
			}

			datepicker
				.append(month_picker)
				.append(calendar)
				.append(applyButton);

            if (options.insideParent) {
                $(input).parent().append(datetimepicker);
            } else {
                $(options.parentID).append(datetimepicker);
            }

			XDSoft_datetime = function () {
				var _this = this;
				_this.now = function (norecursion) {
					var d = new Date(),
						date,
						time;

					if (!norecursion && options.defaultDate) {
						date = _this.strToDateTime(options.defaultDate);
						d.setFullYear(date.getFullYear());
						d.setMonth(date.getMonth());
						d.setDate(date.getDate());
					}

					d.setFullYear(d.getFullYear());

					if (!norecursion && options.defaultTime) {
						time = _this.strtotime(options.defaultTime);
						d.setHours(time.getHours());
						d.setMinutes(time.getMinutes());
						d.setSeconds(time.getSeconds());
						d.setMilliseconds(time.getMilliseconds());
					}
					return d;
				};

				_this.isValidDate = function (d) {
					if (Object.prototype.toString.call(d) !== "[object Date]") {
						return false;
					}
					return !isNaN(d.getTime());
				};

				_this.setCurrentTime = function (dTime, requireValidDate) {
					if (typeof dTime === 'string') {
						_this.currentTime = _this.strToDateTime(dTime);
					}
					else if (_this.isValidDate(dTime)) {
						_this.currentTime = dTime;
					}
					else if (!dTime && !requireValidDate && options.allowBlank && !options.inline) {
						_this.currentTime = null;
					}
					else {
						_this.currentTime = _this.now();
					}

					datetimepicker.trigger('xchange.xdsoft');
				};

				_this.empty = function () {
					_this.currentTime = null;
				};

				_this.getCurrentTime = function () {
					return _this.currentTime;
				};

				_this.nextMonth = function () {

					if (_this.currentTime === undefined || _this.currentTime === null) {
						_this.currentTime = _this.now();
					}

					var month = _this.currentTime.getMonth() + 1,
						year;
					if (month === 12) {
						_this.currentTime.setFullYear(_this.currentTime.getFullYear() + 1);
						month = 0;
					}

					year = _this.currentTime.getFullYear();

					_this.currentTime.setDate(
						Math.min(
							new Date(_this.currentTime.getFullYear(), month + 1, 0).getDate(),
							_this.currentTime.getDate()
						)
					);
					_this.currentTime.setMonth(month);

					if (options.onChangeMonth && typeof options.onChangeMonth === 'function') {
						options.onChangeMonth.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'));
					}

					if (year !== _this.currentTime.getFullYear() && typeof options.onChangeYear === 'function') {
						options.onChangeYear.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'));
					}

					datetimepicker.trigger('xchange.xdsoft');
					return month;
				};

				_this.prevMonth = function () {

					if (_this.currentTime === undefined || _this.currentTime === null) {
						_this.currentTime = _this.now();
					}

					var month = _this.currentTime.getMonth() - 1;
					if (month === -1) {
						_this.currentTime.setFullYear(_this.currentTime.getFullYear() - 1);
						month = 11;
					}
					_this.currentTime.setDate(
						Math.min(
							new Date(_this.currentTime.getFullYear(), month + 1, 0).getDate(),
							_this.currentTime.getDate()
						)
					);
					_this.currentTime.setMonth(month);
					if (options.onChangeMonth && typeof options.onChangeMonth === 'function') {
						options.onChangeMonth.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'));
					}
					datetimepicker.trigger('xchange.xdsoft');
					return month;
				};

				_this.getWeekOfYear = function (datetime) {
					if (options.onGetWeekOfYear && typeof options.onGetWeekOfYear === 'function') {
						var week = options.onGetWeekOfYear.call(datetimepicker, datetime);
						if (typeof week !== 'undefined') {
							return week;
						}
					}
					var onejan = new Date(datetime.getFullYear(), 0, 1);

					//First week of the year is th one with the first Thursday according to ISO8601
					if (onejan.getDay() !== 4) {
						onejan.setMonth(0, 1 + ((4 - onejan.getDay()+ 7) % 7));
					}

					return Math.ceil((((datetime - onejan) / 86400000) + onejan.getDay() + 1) / 7);
				};

				_this.strToDateTime = function (sDateTime) {
					var tmpDate = [], timeOffset, currentTime;

					if (sDateTime && sDateTime instanceof Date && _this.isValidDate(sDateTime)) {
						return sDateTime;
					}

					tmpDate = /^([+-]{1})(.*)$/.exec(sDateTime);

					if (tmpDate) {
						tmpDate[2] = dateHelper.parseDate(tmpDate[2], options.formatDate);
					}

					if (tmpDate  && tmpDate[2]) {
						timeOffset = tmpDate[2].getTime() - (tmpDate[2].getTimezoneOffset()) * 60000;
						currentTime = new Date((_this.now(true)).getTime() + parseInt(tmpDate[1] + '1', 10) * timeOffset);
					} else {
						currentTime = sDateTime ? dateHelper.parseDate(sDateTime, options.format) : _this.now();
					}

					if (!_this.isValidDate(currentTime)) {
						currentTime = _this.now();
					}

					return currentTime;
				};

				_this.strToDate = function (sDate) {
					if (sDate && sDate instanceof Date && _this.isValidDate(sDate)) {
						return sDate;
					}

					var currentTime = sDate ? dateHelper.parseDate(sDate, options.formatDate) : _this.now(true);
					if (!_this.isValidDate(currentTime)) {
						currentTime = _this.now(true);
					}
					return currentTime;
				};

				_this.strtotime = function (sTime) {
					if (sTime && sTime instanceof Date && _this.isValidDate(sTime)) {
						return sTime;
					}
					var currentTime = sTime ? dateHelper.parseDate(sTime, options.formatTime) : _this.now(true);
					if (!_this.isValidDate(currentTime)) {
						currentTime = _this.now(true);
					}
					return currentTime;
				};

				_this.str = function () {
					var format = options.format;
					if (options.yearOffset) {
						format = format.replace('Y', _this.currentTime.getFullYear() + options.yearOffset);
						format = format.replace('y', String(_this.currentTime.getFullYear() + options.yearOffset).substring(2, 4));
					}
					return dateHelper.formatDate(_this.currentTime, format);
				};
				_this.currentTime = this.now();
			};

			_xdsoft_datetime = new XDSoft_datetime();

			applyButton.on('touchend click', function (e) {//pathbrite
				e.preventDefault();
				datetimepicker.data('changed', true);
				_xdsoft_datetime.setCurrentTime(getCurrentValue());
				input.val(_xdsoft_datetime.str());
				datetimepicker.trigger('close.xdsoft');
			});
			month_picker
				.find('.xdsoft_today_button')
				.on('touchend mousedown.xdsoft', function () {
					datetimepicker.data('changed', true);
					_xdsoft_datetime.setCurrentTime(0, true);
					datetimepicker.trigger('afterOpen.xdsoft');
				}).on('dblclick.xdsoft', function () {
				var currentDate = _xdsoft_datetime.getCurrentTime(), minDate, maxDate;
				currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
				minDate = _xdsoft_datetime.strToDate(options.minDate);
				minDate = new Date(minDate.getFullYear(), minDate.getMonth(), minDate.getDate());
				if (currentDate < minDate) {
					return;
				}
				maxDate = _xdsoft_datetime.strToDate(options.maxDate);
				maxDate = new Date(maxDate.getFullYear(), maxDate.getMonth(), maxDate.getDate());
				if (currentDate > maxDate) {
					return;
				}
				input.val(_xdsoft_datetime.str());
				input.trigger('change');
				datetimepicker.trigger('close.xdsoft');
			});
			month_picker
				.find('.xdsoft_prev,.xdsoft_next')
				.on('touchend mousedown.xdsoft', function () {
					var $this = $(this),
						timer = 0,
						stop = false;

					(function arguments_callee1(v) {
						if ($this.hasClass(options.next)) {
							_xdsoft_datetime.nextMonth();
						} else if ($this.hasClass(options.prev)) {
							_xdsoft_datetime.prevMonth();
						}
						if (options.monthChangeSpinner) {
							if (!stop) {
								timer = setTimeout(arguments_callee1, v || 100);
							}
						}
					}(500));

					$([options.ownerDocument.body, options.contentWindow]).on('touchend mouseup.xdsoft', function arguments_callee2() {
						clearTimeout(timer);
						stop = true;
						$([options.ownerDocument.body, options.contentWindow]).off('touchend mouseup.xdsoft', arguments_callee2);
					});
				});

			timepicker
				.find('.xdsoft_prev,.xdsoft_next')
				.on('touchend mousedown.xdsoft', function () {
					var $this = $(this),
						timer = 0,
						stop = false,
						period = 110;
					(function arguments_callee4(v) {
						var pheight = timeboxparent[0].clientHeight,
							height = timebox[0].offsetHeight,
							top = Math.abs(parseInt(timebox.css('marginTop'), 10));
						/**
						 *  Fixes a bug which happens if:
						 *  top is < the timeHeightInTimePicker, it will cause the up arrow to stop working
						 *  same for the down arrow if it's not exactly on the pixel
						 */
						if (top < options.timeHeightInTimePicker) {
							top = options.timeHeightInTimePicker;
						} else if ($this.hasClass(options.next) && (height - pheight) < top) {
							timebox.css('marginTop', '-' + height + 'px');
						}

						if ($this.hasClass(options.next) && (height - pheight) > top) {
							timebox.css('marginTop', '-' + (top + options.timeHeightInTimePicker) + 'px');
						} else if ($this.hasClass(options.prev) && top - options.timeHeightInTimePicker >= 0) {
							timebox.css('marginTop', '-' + (top - options.timeHeightInTimePicker) + 'px');
						}
						/**
						 * Fixed bug:
						 * When using css3 transition, it will cause a bug that you cannot scroll the timepicker list.
						 * The reason is that the transition-duration time, if you set it to 0, all things fine, otherwise, this
						 * would cause a bug when you use jquery.css method.
						 * Let's say: * { transition: all .5s ease; }
						 * jquery timebox.css('marginTop') will return the original value which is before you clicking the next/prev button,
						 * meanwhile the timebox[0].style.marginTop will return the right value which is after you clicking the
						 * next/prev button.
						 *
						 * What we should do:
						 * Replace timebox.css('marginTop') with timebox[0].style.marginTop.
						 */
						timeboxparent.trigger('scroll_element.xdsoft_scroller', [Math.abs(parseInt(timebox[0].style.marginTop, 10) / (height - pheight))]);
						period = (period > 10) ? 10 : period - 10;
						if (!stop) {
							timer = setTimeout(arguments_callee4, v || period);
						}
					}(500));
					$([options.ownerDocument.body, options.contentWindow]).on('touchend mouseup.xdsoft', function arguments_callee5() {
						clearTimeout(timer);
						stop = true;
						$([options.ownerDocument.body, options.contentWindow])
							.off('touchend mouseup.xdsoft', arguments_callee5);
					});
				});

			xchangeTimer = 0;
			// base handler - generating a calendar and timepicker
			datetimepicker
				.on('xchange.xdsoft', function (event) {
					clearTimeout(xchangeTimer);
					xchangeTimer = setTimeout(function () {

						if (_xdsoft_datetime.currentTime === undefined || _xdsoft_datetime.currentTime === null || isNaN(_xdsoft_datetime.currentTime.getTime())) {
							_xdsoft_datetime.currentTime = _xdsoft_datetime.now();
						}

						var table =	'',
							start = new Date(_xdsoft_datetime.currentTime.getFullYear(), _xdsoft_datetime.currentTime.getMonth(), 1, 12, 0, 0),
							i = 0,
							j,
							today = _xdsoft_datetime.now(),
							maxDate = false,
							minDate = false,
							minDateTime = false,
							maxDateTime = false,
							hDate,
							day,
							d,
							y,
							m,
							w,
							classes = [],
							customDateSettings,
							newRow = true,
							time = '',
							h,
							line_time,
							description;

						while (start.getDay() !== options.dayOfWeekStart) {
							start.setDate(start.getDate() - 1);
						}

						table += '<table><thead><tr>';

						if (options.weeks) {
							table += '<th></th>';
						}

						for (j = 0; j < 7; j += 1) {
							table += '<th>' + options.i18n[globalLocale].dayOfWeekShort[(j + options.dayOfWeekStart) % 7] + '</th>';
						}

						table += '</tr></thead>';
						table += '<tbody>';

						if (options.maxDate !== false) {
							maxDate = _xdsoft_datetime.strToDate(options.maxDate);
							maxDate = new Date(maxDate.getFullYear(), maxDate.getMonth(), maxDate.getDate(), 23, 59, 59, 999);
						}

						if (options.minDate !== false) {
							minDate = _xdsoft_datetime.strToDate(options.minDate);
							minDate = new Date(minDate.getFullYear(), minDate.getMonth(), minDate.getDate());
						}

                        if (options.minDateTime !== false) {
							minDateTime = _xdsoft_datetime.strToDate(options.minDateTime);
							minDateTime = new Date(minDateTime.getFullYear(), minDateTime.getMonth(), minDateTime.getDate(), minDateTime.getHours(), minDateTime.getMinutes(), minDateTime.getSeconds());
						}

                        if (options.maxDateTime !== false) {
							maxDateTime = _xdsoft_datetime.strToDate(options.maxDateTime);
							maxDateTime = new Date(maxDateTime.getFullYear(), maxDateTime.getMonth(), maxDateTime.getDate(), maxDateTime.getHours(), maxDateTime.getMinutes(), maxDateTime.getSeconds());
						}

						var maxDateTimeDay;
						if (maxDateTime !== false) {
							maxDateTimeDay = ((maxDateTime.getFullYear() * 12) + maxDateTime.getMonth()) * 31 + maxDateTime.getDate();
						}

						while (i < _xdsoft_datetime.currentTime.countDaysInMonth() || start.getDay() !== options.dayOfWeekStart || _xdsoft_datetime.currentTime.getMonth() === start.getMonth()) {
							classes = [];
							i += 1;

							day = start.getDay();
							d = start.getDate();
							y = start.getFullYear();
							m = start.getMonth();
							w = _xdsoft_datetime.getWeekOfYear(start);
							description = '';

							classes.push('xdsoft_date');

							if (options.beforeShowDay && typeof options.beforeShowDay.call === 'function') {
								customDateSettings = options.beforeShowDay.call(datetimepicker, start);
							} else {
								customDateSettings = null;
							}

							if(options.allowDateRe && Object.prototype.toString.call(options.allowDateRe) === "[object RegExp]"){
								if(!options.allowDateRe.test(dateHelper.formatDate(start, options.formatDate))){
									classes.push('xdsoft_disabled');
								}
							}

							if(options.allowDates && options.allowDates.length>0){
								if(options.allowDates.indexOf(dateHelper.formatDate(start, options.formatDate)) === -1){
									classes.push('xdsoft_disabled');
								}
							}

							var currentDay = ((start.getFullYear() * 12) + start.getMonth()) * 31 + start.getDate();
							if ((maxDate !== false && start > maxDate) || (minDateTime !== false && start < minDateTime)  || (minDate !== false && start < minDate) || (maxDateTime !== false && currentDay > maxDateTimeDay) || (customDateSettings && customDateSettings[0] === false)) {
								classes.push('xdsoft_disabled');
							}

							if (options.disabledDates.indexOf(dateHelper.formatDate(start, options.formatDate)) !== -1) {
								classes.push('xdsoft_disabled');
							}

							if (options.disabledWeekDays.indexOf(day) !== -1) {
								classes.push('xdsoft_disabled');
							}

							if (input.is('[disabled]')) {
								classes.push('xdsoft_disabled');
							}

							if (customDateSettings && customDateSettings[1] !== "") {
								classes.push(customDateSettings[1]);
							}

							if (_xdsoft_datetime.currentTime.getMonth() !== m) {
								classes.push('xdsoft_other_month');
							}

							if ((options.defaultSelect || datetimepicker.data('changed')) && dateHelper.formatDate(_xdsoft_datetime.currentTime, options.formatDate) === dateHelper.formatDate(start, options.formatDate)) {
								classes.push('xdsoft_current');
							}

							if (dateHelper.formatDate(today, options.formatDate) === dateHelper.formatDate(start, options.formatDate)) {
								classes.push('xdsoft_today');
							}

							if (start.getDay() === 0 || start.getDay() === 6 || options.weekends.indexOf(dateHelper.formatDate(start, options.formatDate)) !== -1) {
								classes.push('xdsoft_weekend');
							}

							if (options.highlightedDates[dateHelper.formatDate(start, options.formatDate)] !== undefined) {
								hDate = options.highlightedDates[dateHelper.formatDate(start, options.formatDate)];
								classes.push(hDate.style === undefined ? 'xdsoft_highlighted_default' : hDate.style);
								description = hDate.desc === undefined ? '' : hDate.desc;
							}

							if (options.beforeShowDay && typeof options.beforeShowDay === 'function') {
								classes.push(options.beforeShowDay(start));
							}

							if (newRow) {
								table += '<tr>';
								newRow = false;
								if (options.weeks) {
									table += '<th>' + w + '</th>';
								}
							}

							table += '<td data-date="' + d + '" data-month="' + m + '" data-year="' + y + '"' + ' class="xdsoft_date xdsoft_day_of_week' + start.getDay() + ' ' + classes.join(' ') + '" title="' + description + '">' +
								'<div>' + d + '</div>' +
								'</td>';

							if (start.getDay() === options.dayOfWeekStartPrev) {
								table += '</tr>';
								newRow = true;
							}

							start.setDate(d + 1);
						}
						table += '</tbody></table>';

						calendar.html(table);

						month_picker.find('.xdsoft_label span').eq(0).text(options.i18n[globalLocale].months[_xdsoft_datetime.currentTime.getMonth()]);
						month_picker.find('.xdsoft_label span').eq(1).text(_xdsoft_datetime.currentTime.getFullYear() + options.yearOffset);

						// generate timebox
						time = '';
						h = '';
						m = '';

						var minTimeMinutesOfDay = 0;
						if (options.minTime !== false) {
						    var t = _xdsoft_datetime.strtotime(options.minTime);
						    minTimeMinutesOfDay = 60 * t.getHours() + t.getMinutes();
						}
						var maxTimeMinutesOfDay = 24 * 60;
						if (options.maxTime !== false) {
						    var t = _xdsoft_datetime.strtotime(options.maxTime);
						    maxTimeMinutesOfDay = 60 * t.getHours() + t.getMinutes();
						}

						if (options.minDateTime !== false) {
							var t = _xdsoft_datetime.strToDateTime(options.minDateTime);
						        var currentDayIsMinDateTimeDay = dateHelper.formatDate(_xdsoft_datetime.currentTime, options.formatDate) === dateHelper.formatDate(t, options.formatDate);
							if (currentDayIsMinDateTimeDay) {
								var m = 60 * t.getHours() + t.getMinutes();
								if (m > minTimeMinutesOfDay) minTimeMinutesOfDay = m;
							}
						}

						if (options.maxDateTime !== false) {
							var t = _xdsoft_datetime.strToDateTime(options.maxDateTime);
						        var currentDayIsMaxDateTimeDay = dateHelper.formatDate(_xdsoft_datetime.currentTime, options.formatDate) === dateHelper.formatDate(t, options.formatDate);
							if (currentDayIsMaxDateTimeDay) {
								var m = 60 * t.getHours() + t.getMinutes();
								if (m < maxTimeMinutesOfDay) maxTimeMinutesOfDay = m;
							}
						}

						line_time = function line_time(h, m) {
							var now = _xdsoft_datetime.now(), current_time,
								isALlowTimesInit = options.allowTimes && Array.isArray(options.allowTimes) && options.allowTimes.length;
							now.setHours(h);
							h = parseInt(now.getHours(), 10);
							now.setMinutes(m);
							m = parseInt(now.getMinutes(), 10);
							classes = [];
							var currentMinutesOfDay = 60 * h + m;
							if (input.is('[disabled]') || (currentMinutesOfDay >= maxTimeMinutesOfDay) || (currentMinutesOfDay < minTimeMinutesOfDay)) {
								classes.push('xdsoft_disabled');
							}

							current_time = new Date(_xdsoft_datetime.currentTime);
							current_time.setHours(parseInt(_xdsoft_datetime.currentTime.getHours(), 10));

							if (!isALlowTimesInit) {
								current_time.setMinutes(Math[options.roundTime](_xdsoft_datetime.currentTime.getMinutes() / options.step) * options.step);
							}

							if ((options.initTime || options.defaultSelect || datetimepicker.data('changed')) && current_time.getHours() === parseInt(h, 10) && ((!isALlowTimesInit && options.step > 59) || current_time.getMinutes() === parseInt(m, 10))) {
								if (options.defaultSelect || datetimepicker.data('changed')) {
									classes.push('xdsoft_current');
								} else if (options.initTime) {
									classes.push('xdsoft_init_time');
								}
							}
							if (parseInt(today.getHours(), 10) === parseInt(h, 10) && parseInt(today.getMinutes(), 10) === parseInt(m, 10)) {
								classes.push('xdsoft_today');
							}
							time += '<div class="xdsoft_time ' + classes.join(' ') + '" data-hour="' + h + '" data-minute="' + m + '">' + dateHelper.formatDate(now, options.formatTime) + '</div>';
						};

						if (!options.allowTimes || !Array.isArray(options.allowTimes) || !options.allowTimes.length) {
							for (i = 0, j = 0; i < (options.hours12 ? 12 : 24); i += 1) {
								for (j = 0; j < 60; j += options.step) {
								        var currentMinutesOfDay = i * 60 + j;
								        if (currentMinutesOfDay < minTimeMinutesOfDay) continue;
								        if (currentMinutesOfDay >= maxTimeMinutesOfDay) continue;
									h = (i < 10 ? '0' : '') + i;
									m = (j < 10 ? '0' : '') + j;
									line_time(h, m);
								}
							}
						} else {
							for (i = 0; i < options.allowTimes.length; i += 1) {
								h = _xdsoft_datetime.strtotime(options.allowTimes[i]).getHours();
								m = _xdsoft_datetime.strtotime(options.allowTimes[i]).getMinutes();
								line_time(h, m);
							}
						}

						timebox.html(time);

						opt = '';

						for (i = parseInt(options.yearStart, 10); i <= parseInt(options.yearEnd, 10); i += 1) {
							opt += '<div class="xdsoft_option ' + (_xdsoft_datetime.currentTime.getFullYear() === i ? 'xdsoft_current' : '') + '" data-value="' + i + '">' + (i + options.yearOffset) + '</div>';
						}
						yearselect.children().eq(0)
							.html(opt);

						for (i = parseInt(options.monthStart, 10), opt = ''; i <= parseInt(options.monthEnd, 10); i += 1) {
							opt += '<div class="xdsoft_option ' + (_xdsoft_datetime.currentTime.getMonth() === i ? 'xdsoft_current' : '') + '" data-value="' + i + '">' + options.i18n[globalLocale].months[i] + '</div>';
						}
						monthselect.children().eq(0).html(opt);
						$(datetimepicker)
							.trigger('generate.xdsoft');
					}, 10);
					event.stopPropagation();
				})
				.on('afterOpen.xdsoft', function () {
					if (options.timepicker) {
						var classType, pheight, height, top;
						if (timebox.find('.xdsoft_current').length) {
							classType = '.xdsoft_current';
						} else if (timebox.find('.xdsoft_init_time').length) {
							classType = '.xdsoft_init_time';
						}
						if (classType) {
							pheight = timeboxparent[0].clientHeight;
							height = timebox[0].offsetHeight;
							top = timebox.find(classType).index() * options.timeHeightInTimePicker + 1;
							if ((height - pheight) < top) {
								top = height - pheight;
							}
							timeboxparent.trigger('scroll_element.xdsoft_scroller', [parseInt(top, 10) / (height - pheight)]);
						} else {
							timeboxparent.trigger('scroll_element.xdsoft_scroller', [0]);
						}
					}
				});

			timerclick = 0;
			calendar
				.on('touchend click.xdsoft', 'td', function (xdevent) {
					xdevent.stopPropagation();  // Prevents closing of Pop-ups, Modals and Flyouts in Bootstrap
					timerclick += 1;
					var $this = $(this),
						currentTime = _xdsoft_datetime.currentTime;

					if (currentTime === undefined || currentTime === null) {
						_xdsoft_datetime.currentTime = _xdsoft_datetime.now();
						currentTime = _xdsoft_datetime.currentTime;
					}

					if ($this.hasClass('xdsoft_disabled')) {
						return false;
					}

					currentTime.setDate(1);
					currentTime.setFullYear($this.data('year'));
					currentTime.setMonth($this.data('month'));
					currentTime.setDate($this.data('date'));

					datetimepicker.trigger('select.xdsoft', [currentTime]);

					input.val(_xdsoft_datetime.str());

					if (options.onSelectDate &&	typeof options.onSelectDate === 'function') {
						options.onSelectDate.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'), xdevent);
					}

					datetimepicker.data('changed', true);
					datetimepicker.trigger('xchange.xdsoft');
					datetimepicker.trigger('changedatetime.xdsoft');
					if ((timerclick > 1 || (options.closeOnDateSelect === true || (options.closeOnDateSelect === false && !options.timepicker))) && !options.inline) {
						datetimepicker.trigger('close.xdsoft');
					}
					setTimeout(function () {
						timerclick = 0;
					}, 200);
				});

			timebox
				.on('touchstart', 'div', function (xdevent) {
					this.touchMoved = false;
				})
				.on('touchmove', 'div', handleTouchMoved)
				.on('touchend click.xdsoft', 'div', function (xdevent) {
					if (!this.touchMoved) {
						xdevent.stopPropagation();
						var $this = $(this),
							currentTime = _xdsoft_datetime.currentTime;

						if (currentTime === undefined || currentTime === null) {
							_xdsoft_datetime.currentTime = _xdsoft_datetime.now();
							currentTime = _xdsoft_datetime.currentTime;
						}

						if ($this.hasClass('xdsoft_disabled')) {
							return false;
						}
						currentTime.setHours($this.data('hour'));
						currentTime.setMinutes($this.data('minute'));
						datetimepicker.trigger('select.xdsoft', [currentTime]);

						datetimepicker.data('input').val(_xdsoft_datetime.str());

						if (options.onSelectTime && typeof options.onSelectTime === 'function') {
							options.onSelectTime.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'), xdevent);
						}
						datetimepicker.data('changed', true);
						datetimepicker.trigger('xchange.xdsoft');
						datetimepicker.trigger('changedatetime.xdsoft');
						if (options.inline !== true && options.closeOnTimeSelect === true) {
							datetimepicker.trigger('close.xdsoft');
						}
					}
				});

			datepicker
				.on('mousewheel.xdsoft', function (event) {
					if (!options.scrollMonth) {
						return true;
					}
					if (event.deltaY < 0) {
						_xdsoft_datetime.nextMonth();
					} else {
						_xdsoft_datetime.prevMonth();
					}
					return false;
				});

			input
				.on('mousewheel.xdsoft', function (event) {
					if (!options.scrollInput) {
						return true;
					}
					if (!options.datepicker && options.timepicker) {
						current_time_index = timebox.find('.xdsoft_current').length ? timebox.find('.xdsoft_current').eq(0).index() : 0;
						if (current_time_index + event.deltaY >= 0 && current_time_index + event.deltaY < timebox.children().length) {
							current_time_index += event.deltaY;
						}
						if (timebox.children().eq(current_time_index).length) {
							timebox.children().eq(current_time_index).trigger('mousedown');
						}
						return false;
					}
					if (options.datepicker && !options.timepicker) {
						datepicker.trigger(event, [event.deltaY, event.deltaX, event.deltaY]);
						if (input.val) {
							input.val(_xdsoft_datetime.str());
						}
						datetimepicker.trigger('changedatetime.xdsoft');
						return false;
					}
				});

			datetimepicker
				.on('changedatetime.xdsoft', function (event) {
					if (options.onChangeDateTime && typeof options.onChangeDateTime === 'function') {
						var $input = datetimepicker.data('input');
						options.onChangeDateTime.call(datetimepicker, _xdsoft_datetime.currentTime, $input, event);
						delete options.value;
						$input.trigger('change');
					}
				})
				.on('generate.xdsoft', function () {
					if (options.onGenerate && typeof options.onGenerate === 'function') {
						options.onGenerate.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'));
					}
					if (triggerAfterOpen) {
						datetimepicker.trigger('afterOpen.xdsoft');
						triggerAfterOpen = false;
					}
				})
				.on('click.xdsoft', function (xdevent) {
					xdevent.stopPropagation();
				});

			current_time_index = 0;

			/**
			 * Runs the callback for each of the specified node's ancestors.
			 *
			 * Return FALSE from the callback to stop ascending.
			 *
			 * @param {DOMNode} node
			 * @param {Function} callback
			 * @returns {undefined}
			 */
			forEachAncestorOf = function (node, callback) {
				do {
					node = node.parentNode;

					if (!node || callback(node) === false) {
						break;
					}
				} while (node.nodeName !== 'HTML');
			};

			/**
			 * Sets the position of the picker.
			 *
			 * @returns {undefined}
			 */
			setPos = function () {
				var dateInputOffset,
					dateInputElem,
					verticalPosition,
					left,
					position,
					datetimepickerElem,
					dateInputHasFixedAncestor,
					$dateInput,
					windowWidth,
					verticalAnchorEdge,
					datetimepickerCss,
					windowHeight,
					windowScrollTop;

				$dateInput = datetimepicker.data('input');
				dateInputOffset = $dateInput.offset();
				dateInputElem = $dateInput[0];

				verticalAnchorEdge = 'top';
				verticalPosition = (dateInputOffset.top + dateInputElem.offsetHeight) - 1;
				left = dateInputOffset.left;
				position = "absolute";

				windowWidth = $(options.contentWindow).width();
				windowHeight = $(options.contentWindow).height();
				windowScrollTop = $(options.contentWindow).scrollTop();

				if ((options.ownerDocument.documentElement.clientWidth - dateInputOffset.left) < datepicker.parent().outerWidth(true)) {
					var diff = datepicker.parent().outerWidth(true) - dateInputElem.offsetWidth;
					left = left - diff;
				}

				if ($dateInput.parent().css('direction') === 'rtl') {
					left -= (datetimepicker.outerWidth() - $dateInput.outerWidth());
				}

				if (options.fixed) {
					verticalPosition -= windowScrollTop;
					left -= $(options.contentWindow).scrollLeft();
					position = "fixed";
				} else {
					dateInputHasFixedAncestor = false;

					forEachAncestorOf(dateInputElem, function (ancestorNode) {
						if (ancestorNode === null) {
							return false;
						}

						if (options.contentWindow.getComputedStyle(ancestorNode).getPropertyValue('position') === 'fixed') {
							dateInputHasFixedAncestor = true;
							return false;
						}
					});

					if (dateInputHasFixedAncestor && !options.insideParent) {
						position = 'fixed';

						//If the picker won't fit entirely within the viewport then display it above the date input.
						if (verticalPosition + datetimepicker.outerHeight() > windowHeight + windowScrollTop) {
							verticalAnchorEdge = 'bottom';
							verticalPosition = (windowHeight + windowScrollTop) - dateInputOffset.top;
						} else {
							verticalPosition -= windowScrollTop;
						}
					} else {
						if (verticalPosition + datetimepicker[0].offsetHeight > windowHeight + windowScrollTop) {
							verticalPosition = dateInputOffset.top - datetimepicker[0].offsetHeight + 1;
						}
					}

					if (verticalPosition < 0) {
						verticalPosition = 0;
					}

					if (left + dateInputElem.offsetWidth > windowWidth) {
						left = windowWidth - dateInputElem.offsetWidth;
					}
				}

				datetimepickerElem = datetimepicker[0];

				forEachAncestorOf(datetimepickerElem, function (ancestorNode) {
					var ancestorNodePosition;

					ancestorNodePosition = options.contentWindow.getComputedStyle(ancestorNode).getPropertyValue('position');

					if (ancestorNodePosition === 'relative' && windowWidth >= ancestorNode.offsetWidth) {
						left = left - ((windowWidth - ancestorNode.offsetWidth) / 2);
						return false;
					}
				});

				datetimepickerCss = {
					position: position,
					left: options.insideParent ? dateInputElem.offsetLeft : left,
					top: '',  //Initialize to prevent previous values interfering with new ones.
					bottom: ''  //Initialize to prevent previous values interfering with new ones.
				};

				if (options.insideParent) {
                    datetimepickerCss[verticalAnchorEdge] = dateInputElem.offsetTop + dateInputElem.offsetHeight;
                } else {
                    datetimepickerCss[verticalAnchorEdge] = verticalPosition;
                }

				datetimepicker.css(datetimepickerCss);
			};

			datetimepicker
				.on('open.xdsoft', function (event) {
					var onShow = true;
					if (options.onShow && typeof options.onShow === 'function') {
						onShow = options.onShow.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'), event);
					}
					if (onShow !== false) {
						datetimepicker.show();
						setPos();
						$(options.contentWindow)
							.off('resize.xdsoft', setPos)
							.on('resize.xdsoft', setPos);

						if (options.closeOnWithoutClick) {
							$([options.ownerDocument.body, options.contentWindow]).on('touchstart mousedown.xdsoft', function arguments_callee6() {
								datetimepicker.trigger('close.xdsoft');
								$([options.ownerDocument.body, options.contentWindow]).off('touchstart mousedown.xdsoft', arguments_callee6);
							});
						}
					}
				})
				.on('close.xdsoft', function (event) {
					var onClose = true;
					month_picker
						.find('.xdsoft_month,.xdsoft_year')
						.find('.xdsoft_select')
						.hide();
					if (options.onClose && typeof options.onClose === 'function') {
						onClose = options.onClose.call(datetimepicker, _xdsoft_datetime.currentTime, datetimepicker.data('input'), event);
					}
					if (onClose !== false && !options.opened && !options.inline) {
						datetimepicker.hide();
					}
					event.stopPropagation();
				})
				.on('toggle.xdsoft', function () {
					if (datetimepicker.is(':visible')) {
						datetimepicker.trigger('close.xdsoft');
					} else {
						datetimepicker.trigger('open.xdsoft');
					}
				})
				.data('input', input);

			timer = 0;

			datetimepicker.data('xdsoft_datetime', _xdsoft_datetime);
			datetimepicker.setOptions(options);

			function getCurrentValue() {
				var ct = false, time;

				if (options.startDate) {
					ct = _xdsoft_datetime.strToDate(options.startDate);
				} else {
					ct = options.value || ((input && input.val && input.val()) ? input.val() : '');
					if (ct) {
						ct = _xdsoft_datetime.strToDateTime(ct);
						if (options.yearOffset) {
							ct = new Date(ct.getFullYear() - options.yearOffset, ct.getMonth(), ct.getDate(), ct.getHours(), ct.getMinutes(), ct.getSeconds(), ct.getMilliseconds());
						}
					} else if (options.defaultDate) {
						ct = _xdsoft_datetime.strToDateTime(options.defaultDate);
						if (options.defaultTime) {
							time = _xdsoft_datetime.strtotime(options.defaultTime);
							ct.setHours(time.getHours());
							ct.setMinutes(time.getMinutes());
						}
					}
				}

				if (ct && _xdsoft_datetime.isValidDate(ct)) {
					datetimepicker.data('changed', true);
				} else {
					ct = '';
				}

				return ct || 0;
			}

			function setMask(options) {

				var isValidValue = function (mask, value) {
						var reg = mask
							.replace(/([\[\]\/\{\}\(\)\-\.\+]{1})/g, '\\$1')
							.replace(/_/g, '{digit+}')
							.replace(/([0-9]{1})/g, '{digit$1}')
							.replace(/\{digit([0-9]{1})\}/g, '[0-$1_]{1}')
							.replace(/\{digit[\+]\}/g, '[0-9_]{1}');
						return (new RegExp(reg)).test(value);
					},
					getCaretPos = function (input) {
						try {
							if (options.ownerDocument.selection && options.ownerDocument.selection.createRange) {
								var range = options.ownerDocument.selection.createRange();
								return range.getBookmark().charCodeAt(2) - 2;
							}
							if (input.setSelectionRange) {
								return input.selectionStart;
							}
						} catch (e) {
							return 0;
						}
					},
					setCaretPos = function (node, pos) {
						node = (typeof node === "string" || node instanceof String) ? options.ownerDocument.getElementById(node) : node;
						if (!node) {
							return false;
						}
						if (node.createTextRange) {
							var textRange = node.createTextRange();
							textRange.collapse(true);
							textRange.moveEnd('character', pos);
							textRange.moveStart('character', pos);
							textRange.select();
							return true;
						}
						if (node.setSelectionRange) {
							node.setSelectionRange(pos, pos);
							return true;
						}
						return false;
					};

				if(options.mask) {
					input.off('keydown.xdsoft');
				}

				if (options.mask === true) {
					if (dateHelper.formatMask) {
						options.mask = dateHelper.formatMask(options.format)
					} else {
						options.mask = options.format
							.replace(/Y/g, '9999')
							.replace(/F/g, '9999')
							.replace(/m/g, '19')
							.replace(/d/g, '39')
							.replace(/H/g, '29')
							.replace(/i/g, '59')
							.replace(/s/g, '59');
					}
				}

				if (typeof options.mask === 'string') {
					if (!isValidValue(options.mask, input.val())) {
						input.val(options.mask.replace(/[0-9]/g, '_'));
						setCaretPos(input[0], 0);
					}

					input.on('paste.xdsoft', function (event) {
					    // couple options here
					    // 1. return false - tell them they can't paste
					    // 2. insert over current characters - minimal validation
					    // 3. full fledged parsing and validation
					    // let's go option 2 for now

					    // fires multiple times for some reason

					    // https://stackoverflow.com/a/30496488/1366033
					    var clipboardData = event.clipboardData || event.originalEvent.clipboardData || window.clipboardData,
						pastedData = clipboardData.getData('text'),
						val = this.value,
						pos = this.selectionStart

					    var valueBeforeCursor = val.slice(0, pos);
					    var valueAfterPaste = val.slice(pos + pastedData.length);

					    val = valueBeforeCursor + pastedData + valueAfterPaste;
					    pos += pastedData.length;

					    if (isValidValue(options.mask, val)) {
						this.value = val;
						setCaretPos(this, pos);
					    } else if (val.trim() === '') {
						this.value = options.mask.replace(/[0-9]/g, '_');
					    } else {
						input.trigger('error_input.xdsoft');
					    }

					    event.preventDefault();
					    return false;
					  });

					  input.on('keydown.xdsoft', function (event) {
					    var val = this.value,
						key = event.which,
						pos = this.selectionStart,
						selEnd = this.selectionEnd,
						hasSel = pos !== selEnd,
						digit;

					    // only alow these characters
					    if (((key >=  KEY0 && key <=  KEY9)  ||
						 (key >= _KEY0 && key <= _KEY9)) ||
						 (key === BACKSPACE || key === DEL)) {

					      // get char to insert which is new character or placeholder ('_')
					      digit = (key === BACKSPACE || key === DEL) ? '_' :
							  String.fromCharCode((_KEY0 <= key && key <= _KEY9) ? key - KEY0 : key);

						// we're deleting something, we're not at the start, and have normal cursor, move back one
						// if we have a selection length, cursor actually sits behind deletable char, not in front
						if (key === BACKSPACE && pos && !hasSel) {
						    pos -= 1;
						}

						// don't stop on a separator, continue whatever direction you were going
						//   value char - keep incrementing position while on separator char and we still have room
						//   del char   - keep decrementing position while on separator char and we still have room
						while (true) {
						  var maskValueAtCurPos = options.mask.slice(pos, pos+1);
						  var posShorterThanMaskLength = pos < options.mask.length;
						  var posGreaterThanZero = pos > 0;
						  var notNumberOrPlaceholder = /[^0-9_]/;
						  var curPosOnSep = notNumberOrPlaceholder.test(maskValueAtCurPos);
						  var continueMovingPosition = curPosOnSep && posShorterThanMaskLength && posGreaterThanZero

						  // if we hit a real char, stay where we are
						  if (!continueMovingPosition) break;

						  // hitting backspace in a selection, you can possibly go back any further - go forward
						  pos += (key === BACKSPACE && !hasSel) ? -1 : 1;

                        }

                        if (event.metaKey) {    // cmd has been pressed
                            pos = 0;
                            hasSel = true;
                        }

						if (hasSel) {
						  // pos might have moved so re-calc length
						  var selLength = selEnd - pos

						  // if we have a selection length we will wipe out entire selection and replace with default template for that range
						  var defaultBlank = options.mask.replace(/[0-9]/g, '_');
						  var defaultBlankSelectionReplacement = defaultBlank.slice(pos, pos+selLength);
						  var selReplacementRemainder = defaultBlankSelectionReplacement.slice(1) // might be empty

						  var valueBeforeSel = val.slice(0, pos);
						  var insertChars = digit + selReplacementRemainder;
						  var charsAfterSelection = val.slice(pos + selLength);

						  val = valueBeforeSel + insertChars + charsAfterSelection

						} else {
						  var valueBeforeCursor = val.slice(0, pos);
						  var insertChar = digit;
						  var valueAfterNextChar = val.slice(pos + 1);

						  val = valueBeforeCursor + insertChar + valueAfterNextChar
						}

						if (val.trim() === '') {
						  // if empty, set to default
						    val = defaultBlank
						} else {
						  // if at the last character don't need to do anything
						    if (pos === options.mask.length) {
							event.preventDefault();
							return false;
						    }
						}

						// resume cursor location
						pos += (key === BACKSPACE) ? 0 : 1;
						// don't stop on a separator, continue whatever direction you were going
						while (/[^0-9_]/.test(options.mask.slice(pos, pos+1)) && pos < options.mask.length && pos > 0) {
						    pos += (key === BACKSPACE) ? 0 : 1;
						}

						if (isValidValue(options.mask, val)) {
						    this.value = val;
						    setCaretPos(this, pos);
						} else if (val.trim() === '') {
						    this.value = options.mask.replace(/[0-9]/g, '_');
						} else {
						    input.trigger('error_input.xdsoft');
						}
					    } else {
						if (([AKEY, CKEY, VKEY, ZKEY, YKEY].indexOf(key) !== -1 && ctrlDown) || [ESC, ARROWUP, ARROWDOWN, ARROWLEFT, ARROWRIGHT, F5, CTRLKEY, TAB, ENTER].indexOf(key) !== -1) {
						    return true;
						}
					    }

					    event.preventDefault();
					    return false;
					  });
				}
			}

			_xdsoft_datetime.setCurrentTime(getCurrentValue());

			input
				.data('xdsoft_datetimepicker', datetimepicker)
				.on('open.xdsoft focusin.xdsoft mousedown.xdsoft touchstart', function () {
					if (input.is(':disabled') || (input.data('xdsoft_datetimepicker').is(':visible') && options.closeOnInputClick)) {
						return;
					}
					if (!options.openOnFocus) {
						return;
					}
					clearTimeout(timer);
					timer = setTimeout(function () {
						if (input.is(':disabled')) {
							return;
						}

						triggerAfterOpen = true;
						_xdsoft_datetime.setCurrentTime(getCurrentValue(), true);
						if(options.mask) {
							setMask(options);
						}
						datetimepicker.trigger('open.xdsoft');
					}, 100);
				})
				.on('keydown.xdsoft', function (event) {
					var elementSelector,
						key = event.which;
					if ([ENTER].indexOf(key) !== -1 && options.enterLikeTab) {
						elementSelector = $("input:visible,textarea:visible,button:visible,a:visible");
						datetimepicker.trigger('close.xdsoft');
						elementSelector.eq(elementSelector.index(this) + 1).focus();
						return false;
					}
					if ([TAB].indexOf(key) !== -1) {
						datetimepicker.trigger('close.xdsoft');
						return true;
					}
				})
				.on('blur.xdsoft', function () {
					datetimepicker.trigger('close.xdsoft');
				});
		};
		destroyDateTimePicker = function (input) {
			var datetimepicker = input.data('xdsoft_datetimepicker');
			if (datetimepicker) {
				datetimepicker.data('xdsoft_datetime', null);
				datetimepicker.remove();
				input
					.data('xdsoft_datetimepicker', null)
					.off('.xdsoft');
				$(options.contentWindow).off('resize.xdsoft');
				$([options.contentWindow, options.ownerDocument.body]).off('mousedown.xdsoft touchstart');
				if (input.unmousewheel) {
					input.unmousewheel();
				}
			}
		};
		$(options.ownerDocument)
            .off('keydown.xdsoftctrl keyup.xdsoftctrl')
            .off('keydown.xdsoftcmd keyup.xdsoftcmd')
			.on('keydown.xdsoftctrl', function (e) {
				if (e.keyCode === CTRLKEY) {
					ctrlDown = true;
                }
			})
			.on('keyup.xdsoftctrl', function (e) {
				if (e.keyCode === CTRLKEY) {
					ctrlDown = false;
                }
            })
            .on('keydown.xdsoftcmd', function (e) {
                if (e.keyCode === CMDKEY) {
                    cmdDown = true;
                }
			})
			.on('keyup.xdsoftcmd', function (e) {
                if (e.keyCode === CMDKEY) {
                    cmdDown = false;
                }
			});

		this.each(function () {
			var datetimepicker = $(this).data('xdsoft_datetimepicker'), $input;
			if (datetimepicker) {
				if (typeof opt === 'string') {
					switch (opt) {
						case 'show':
							$(this).select().focus();
							datetimepicker.trigger('open.xdsoft');
							break;
						case 'hide':
							datetimepicker.trigger('close.xdsoft');
							break;
						case 'toggle':
							datetimepicker.trigger('toggle.xdsoft');
							break;
						case 'destroy':
							destroyDateTimePicker($(this));
							break;
						case 'reset':
							this.value = this.defaultValue;
							if (!this.value || !datetimepicker.data('xdsoft_datetime').isValidDate(dateHelper.parseDate(this.value, options.format))) {
								datetimepicker.data('changed', false);
							}
							datetimepicker.data('xdsoft_datetime').setCurrentTime(this.value);
							break;
						case 'validate':
							$input = datetimepicker.data('input');
							$input.trigger('blur.xdsoft');
							break;
						default:
							if (datetimepicker[opt] && typeof datetimepicker[opt] === 'function') {
								result = datetimepicker[opt](opt2);
							}
					}
				} else {
					datetimepicker
						.setOptions(opt);
				}
				return 0;
			}
			if (typeof opt !== 'string') {
				if (!options.lazyInit || options.open || options.inline) {
					createDateTimePicker($(this));
				} else {
					lazyInit($(this));
				}
			}
		});

		return result;
	};

	$.fn.datetimepicker.defaults = default_options;

	function HighlightedDate(date, desc, style) {
		"use strict";
		this.date = date;
		this.desc = desc;
		this.style = style;
	}
};
;(function (factory) {
	if ( typeof define === 'function' && define.amd ) {
		// AMD. Register as an anonymous module.
		define(['jquery', 'jquery-mousewheel'], factory);
	} else if (typeof exports === 'object') {
		// Node/CommonJS style for Browserify
		module.exports = factory(require('jquery'));;
	} else {
		// Browser globals
		factory(jQuery);
	}
}(datetimepickerFactory));



/*! jQuery UI - v1.14.1 - 2024-10-30
* https://jqueryui.com
* Includes: widget.js, position.js, data.js, disable-selection.js, effect.js, effects/effect-blind.js, effects/effect-bounce.js, effects/effect-clip.js, effects/effect-drop.js, effects/effect-explode.js, effects/effect-fade.js, effects/effect-fold.js, effects/effect-highlight.js, effects/effect-puff.js, effects/effect-pulsate.js, effects/effect-scale.js, effects/effect-shake.js, effects/effect-size.js, effects/effect-slide.js, effects/effect-transfer.js, focusable.js, form-reset-mixin.js, jquery-patch.js, keycode.js, labels.js, scroll-parent.js, tabbable.js, unique-id.js, widgets/accordion.js, widgets/autocomplete.js, widgets/button.js, widgets/checkboxradio.js, widgets/controlgroup.js, widgets/datepicker.js, widgets/dialog.js, widgets/draggable.js, widgets/droppable.js, widgets/menu.js, widgets/mouse.js, widgets/progressbar.js, widgets/resizable.js, widgets/selectable.js, widgets/selectmenu.js, widgets/slider.js, widgets/sortable.js, widgets/spinner.js, widgets/tabs.js, widgets/tooltip.js
* Copyright OpenJS Foundation and other contributors; Licensed MIT */

(t=>{"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)})(function(V){V.ui=V.ui||{};V.ui.version="1.14.1";var n,s,x,k,o,a,r,l,h,i,E=0,N=Array.prototype.hasOwnProperty,c=Array.prototype.slice;V.cleanData=(n=V.cleanData,function(t){for(var e,i,s=0;null!=(i=t[s]);s++)(e=V._data(i,"events"))&&e.remove&&V(i).triggerHandler("remove");n(t)}),V.widget=function(t,i,e){var s,n,o,a,r={},l=t.split(".")[0];return"__proto__"===(t=t.split(".")[1])||"constructor"===t?V.error("Invalid widget name: "+t):(a=l+"-"+t,e||(e=i,i=V.Widget),Array.isArray(e)&&(e=V.extend.apply(null,[{}].concat(e))),V.expr.pseudos[a.toLowerCase()]=function(t){return!!V.data(t,a)},V[l]=V[l]||{},s=V[l][t],n=V[l][t]=function(t,e){if(!this||!this._createWidget)return new n(t,e);arguments.length&&this._createWidget(t,e)},V.extend(n,s,{version:e.version,_proto:V.extend({},e),_childConstructors:[]}),(o=new i).options=V.widget.extend({},o.options),V.each(e,function(e,s){function n(){return i.prototype[e].apply(this,arguments)}function o(t){return i.prototype[e].apply(this,t)}r[e]="function"!=typeof s?s:function(){var t,e=this._super,i=this._superApply;return this._super=n,this._superApply=o,t=s.apply(this,arguments),this._super=e,this._superApply=i,t}}),n.prototype=V.widget.extend(o,{widgetEventPrefix:s&&o.widgetEventPrefix||t},r,{constructor:n,namespace:l,widgetName:t,widgetFullName:a}),s?(V.each(s._childConstructors,function(t,e){var i=e.prototype;V.widget(i.namespace+"."+i.widgetName,n,e._proto)}),delete s._childConstructors):i._childConstructors.push(n),V.widget.bridge(t,n),n)},V.widget.extend=function(t){for(var e,i,s=c.call(arguments,1),n=0,o=s.length;n<o;n++)for(e in s[n])i=s[n][e],N.call(s[n],e)&&void 0!==i&&(V.isPlainObject(i)?t[e]=V.isPlainObject(t[e])?V.widget.extend({},t[e],i):V.widget.extend({},i):t[e]=i);return t},V.widget.bridge=function(o,e){var a=e.prototype.widgetFullName||o;V.fn[o]=function(i){var t="string"==typeof i,s=c.call(arguments,1),n=this;return t?this.length||"instance"!==i?this.each(function(){var t,e=V.data(this,a);return"instance"===i?(n=e,!1):e?"function"!=typeof e[i]||"_"===i.charAt(0)?V.error("no such method '"+i+"' for "+o+" widget instance"):(t=e[i].apply(e,s))!==e&&void 0!==t?(n=t&&t.jquery?n.pushStack(t.get()):t,!1):void 0:V.error("cannot call methods on "+o+" prior to initialization; attempted to call method '"+i+"'")}):n=void 0:(s.length&&(i=V.widget.extend.apply(null,[i].concat(s))),this.each(function(){var t=V.data(this,a);t?(t.option(i||{}),t._init&&t._init()):V.data(this,a,new e(i,this))})),n}},V.Widget=function(){},V.Widget._childConstructors=[],V.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{classes:{},disabled:!1,create:null},_createWidget:function(t,e){e=V(e||this.defaultElement||this)[0],this.element=V(e),this.uuid=E++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=V(),this.hoverable=V(),this.focusable=V(),this.classesElementLookup={},e!==this&&(V.data(e,this.widgetFullName,this),this._on(!0,this.element,{remove:function(t){t.target===e&&this.destroy()}}),this.document=V(e.style?e.ownerDocument:e.document||e),this.window=V(this.document[0].defaultView||this.document[0].parentWindow)),this.options=V.widget.extend({},this.options,this._getCreateOptions(),t),this._create(),this.options.disabled&&this._setOptionDisabled(this.options.disabled),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:function(){return{}},_getCreateEventData:V.noop,_create:V.noop,_init:V.noop,destroy:function(){var i=this;this._destroy(),V.each(this.classesElementLookup,function(t,e){i._removeClass(e,t)}),this.element.off(this.eventNamespace).removeData(this.widgetFullName),this.widget().off(this.eventNamespace).removeAttr("aria-disabled"),this.bindings.off(this.eventNamespace)},_destroy:V.noop,widget:function(){return this.element},option:function(t,e){var i,s,n,o=t;if(0===arguments.length)return V.widget.extend({},this.options);if("string"==typeof t)if(o={},t=(i=t.split(".")).shift(),i.length){for(s=o[t]=V.widget.extend({},this.options[t]),n=0;n<i.length-1;n++)s[i[n]]=s[i[n]]||{},s=s[i[n]];if(t=i.pop(),1===arguments.length)return void 0===s[t]?null:s[t];s[t]=e}else{if(1===arguments.length)return void 0===this.options[t]?null:this.options[t];o[t]=e}return this._setOptions(o),this},_setOptions:function(t){for(var e in t)this._setOption(e,t[e]);return this},_setOption:function(t,e){return"classes"===t&&this._setOptionClasses(e),this.options[t]=e,"disabled"===t&&this._setOptionDisabled(e),this},_setOptionClasses:function(t){var e,i,s;for(e in t)s=this.classesElementLookup[e],t[e]!==this.options.classes[e]&&s&&s.length&&(i=V(s.get()),this._removeClass(s,e),i.addClass(this._classes({element:i,keys:e,classes:t,add:!0})))},_setOptionDisabled:function(t){this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,!!t),t&&(this._removeClass(this.hoverable,null,"ui-state-hover"),this._removeClass(this.focusable,null,"ui-state-focus"))},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_classes:function(n){var o=[],a=this;function t(t,e){for(var i,s=0;s<t.length;s++)i=a.classesElementLookup[t[s]]||V(),i=n.add?((()=>{var i=[];n.element.each(function(t,e){V.map(a.classesElementLookup,function(t){return t}).some(function(t){return t.is(e)})||i.push(e)}),a._on(V(i),{remove:"_untrackClassesElement"})})(),V(V.uniqueSort(i.get().concat(n.element.get())))):V(i.not(n.element).get()),a.classesElementLookup[t[s]]=i,o.push(t[s]),e&&n.classes[t[s]]&&o.push(n.classes[t[s]])}return(n=V.extend({element:this.element,classes:this.options.classes||{}},n)).keys&&t(n.keys.match(/\S+/g)||[],!0),n.extra&&t(n.extra.match(/\S+/g)||[]),o.join(" ")},_untrackClassesElement:function(i){var s=this;V.each(s.classesElementLookup,function(t,e){-1!==V.inArray(i.target,e)&&(s.classesElementLookup[t]=V(e.not(i.target).get()))}),this._off(V(i.target))},_removeClass:function(t,e,i){return this._toggleClass(t,e,i,!1)},_addClass:function(t,e,i){return this._toggleClass(t,e,i,!0)},_toggleClass:function(t,e,i,s){var n="string"==typeof t||null===t,e={extra:n?e:i,keys:n?t:e,element:n?this.element:t,add:s="boolean"==typeof s?s:i};return e.element.toggleClass(this._classes(e),s),this},_on:function(n,o,t){var a,r=this;"boolean"!=typeof n&&(t=o,o=n,n=!1),t?(o=a=V(o),this.bindings=this.bindings.add(o)):(t=o,o=this.element,a=this.widget()),V.each(t,function(t,e){function i(){if(n||!0!==r.options.disabled&&!V(this).hasClass("ui-state-disabled"))return("string"==typeof e?r[e]:e).apply(r,arguments)}"string"!=typeof e&&(i.guid=e.guid=e.guid||i.guid||V.guid++);var t=t.match(/^([\w:-]*)\s*(.*)$/),s=t[1]+r.eventNamespace,t=t[2];t?a.on(s,t,i):o.on(s,i)})},_off:function(t,e){e=(e||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,t.off(e),this.bindings=V(this.bindings.not(t).get()),this.focusable=V(this.focusable.not(t).get()),this.hoverable=V(this.hoverable.not(t).get())},_delay:function(t,e){var i=this;return setTimeout(function(){return("string"==typeof t?i[t]:t).apply(i,arguments)},e||0)},_hoverable:function(t){this.hoverable=this.hoverable.add(t),this._on(t,{mouseenter:function(t){this._addClass(V(t.currentTarget),null,"ui-state-hover")},mouseleave:function(t){this._removeClass(V(t.currentTarget),null,"ui-state-hover")}})},_focusable:function(t){this.focusable=this.focusable.add(t),this._on(t,{focusin:function(t){this._addClass(V(t.currentTarget),null,"ui-state-focus")},focusout:function(t){this._removeClass(V(t.currentTarget),null,"ui-state-focus")}})},_trigger:function(t,e,i){var s,n,o=this.options[t];if(i=i||{},(e=V.Event(e)).type=(t===this.widgetEventPrefix?t:this.widgetEventPrefix+t).toLowerCase(),e.target=this.element[0],n=e.originalEvent)for(s in n)s in e||(e[s]=n[s]);return this.element.trigger(e,i),!("function"==typeof o&&!1===o.apply(this.element[0],[e].concat(i))||e.isDefaultPrevented())}},V.each({show:"fadeIn",hide:"fadeOut"},function(o,a){V.Widget.prototype["_"+o]=function(e,t,i){var s,n=(t="string"==typeof t?{effect:t}:t)?!0!==t&&"number"!=typeof t&&t.effect||a:o;"number"==typeof(t=t||{})?t={duration:t}:!0===t&&(t={}),s=!V.isEmptyObject(t),t.complete=i,t.delay&&e.delay(t.delay),s&&V.effects&&V.effects.effect[n]?e[o](t):n!==o&&e[n]?e[n](t.duration,t.easing,i):e.queue(function(t){V(this)[o](),i&&i.call(e[0]),t()})}}),V.widget;function C(t,e,i){return[parseFloat(t[0])*(h.test(t[0])?e/100:1),parseFloat(t[1])*(h.test(t[1])?i/100:1)]}function D(t,e){return parseInt(V.css(t,e),10)||0}function I(t){return null!=t&&t===t.window}x=Math.max,k=Math.abs,o=/left|center|right/,a=/top|center|bottom/,r=/[\+\-]\d+(\.[\d]+)?%?/,l=/^\w+/,h=/%$/,i=V.fn.position,V.position={scrollbarWidth:function(){var t,e,i;return void 0!==s?s:(i=(e=V("<div style='display:block;position:absolute;width:200px;height:200px;overflow:hidden;'><div style='height:300px;width:auto;'></div></div>")).children()[0],V("body").append(e),t=i.offsetWidth,e.css("overflow","scroll"),t===(i=i.offsetWidth)&&(i=e[0].clientWidth),e.remove(),s=t-i)},getScrollInfo:function(t){var e=t.isWindow||t.isDocument?"":t.element.css("overflow-x"),i=t.isWindow||t.isDocument?"":t.element.css("overflow-y"),e="scroll"===e||"auto"===e&&t.width<t.element[0].scrollWidth;return{width:"scroll"===i||"auto"===i&&t.height<t.element[0].scrollHeight?V.position.scrollbarWidth():0,height:e?V.position.scrollbarWidth():0}},getWithinInfo:function(t){var e=V(t||window),i=I(e[0]),s=!!e[0]&&9===e[0].nodeType;return{element:e,isWindow:i,isDocument:s,offset:!i&&!s?V(t).offset():{left:0,top:0},scrollLeft:e.scrollLeft(),scrollTop:e.scrollTop(),width:e.outerWidth(),height:e.outerHeight()}}},V.fn.position=function(u){var d,p,f,g,m,_,v,b,y,w,t,e;return u&&u.of?(_="string"==typeof(u=V.extend({},u)).of?V(document).find(u.of):V(u.of),v=V.position.getWithinInfo(u.within),b=V.position.getScrollInfo(v),y=(u.collision||"flip").split(" "),w={},e=9===(e=(t=_)[0]).nodeType?{width:t.width(),height:t.height(),offset:{top:0,left:0}}:I(e)?{width:t.width(),height:t.height(),offset:{top:t.scrollTop(),left:t.scrollLeft()}}:e.preventDefault?{width:0,height:0,offset:{top:e.pageY,left:e.pageX}}:{width:t.outerWidth(),height:t.outerHeight(),offset:t.offset()},_[0].preventDefault&&(u.at="left top"),p=e.width,f=e.height,m=V.extend({},g=e.offset),V.each(["my","at"],function(){var t,e,i=(u[this]||"").split(" ");(i=1===i.length?o.test(i[0])?i.concat(["center"]):a.test(i[0])?["center"].concat(i):["center","center"]:i)[0]=o.test(i[0])?i[0]:"center",i[1]=a.test(i[1])?i[1]:"center",t=r.exec(i[0]),e=r.exec(i[1]),w[this]=[t?t[0]:0,e?e[0]:0],u[this]=[l.exec(i[0])[0],l.exec(i[1])[0]]}),1===y.length&&(y[1]=y[0]),"right"===u.at[0]?m.left+=p:"center"===u.at[0]&&(m.left+=p/2),"bottom"===u.at[1]?m.top+=f:"center"===u.at[1]&&(m.top+=f/2),d=C(w.at,p,f),m.left+=d[0],m.top+=d[1],this.each(function(){var i,t,a=V(this),r=a.outerWidth(),l=a.outerHeight(),e=D(this,"marginLeft"),s=D(this,"marginTop"),n=r+e+D(this,"marginRight")+b.width,o=l+s+D(this,"marginBottom")+b.height,h=V.extend({},m),c=C(w.my,a.outerWidth(),a.outerHeight());"right"===u.my[0]?h.left-=r:"center"===u.my[0]&&(h.left-=r/2),"bottom"===u.my[1]?h.top-=l:"center"===u.my[1]&&(h.top-=l/2),h.left+=c[0],h.top+=c[1],i={marginLeft:e,marginTop:s},V.each(["left","top"],function(t,e){V.ui.position[y[t]]&&V.ui.position[y[t]][e](h,{targetWidth:p,targetHeight:f,elemWidth:r,elemHeight:l,collisionPosition:i,collisionWidth:n,collisionHeight:o,offset:[d[0]+c[0],d[1]+c[1]],my:u.my,at:u.at,within:v,elem:a})}),u.using&&(t=function(t){var e=g.left-h.left,i=e+p-r,s=g.top-h.top,n=s+f-l,o={target:{element:_,left:g.left,top:g.top,width:p,height:f},element:{element:a,left:h.left,top:h.top,width:r,height:l},horizontal:i<0?"left":0<e?"right":"center",vertical:n<0?"top":0<s?"bottom":"middle"};p<r&&k(e+i)<p&&(o.horizontal="center"),f<l&&k(s+n)<f&&(o.vertical="middle"),x(k(e),k(i))>x(k(s),k(n))?o.important="horizontal":o.important="vertical",u.using.call(this,t,o)}),a.offset(V.extend(h,{using:t}))})):i.apply(this,arguments)},V.ui.position={fit:{left:function(t,e){var i,s=e.within,n=s.isWindow?s.scrollLeft:s.offset.left,s=s.width,o=t.left-e.collisionPosition.marginLeft,a=n-o,r=o+e.collisionWidth-s-n;s<e.collisionWidth?0<a&&r<=0?(i=t.left+a+e.collisionWidth-s-n,t.left+=a-i):t.left=!(0<r&&a<=0)&&r<a?n+s-e.collisionWidth:n:0<a?t.left+=a:0<r?t.left-=r:t.left=x(t.left-o,t.left)},top:function(t,e){var i,s=e.within,s=s.isWindow?s.scrollTop:s.offset.top,n=e.within.height,o=t.top-e.collisionPosition.marginTop,a=s-o,r=o+e.collisionHeight-n-s;n<e.collisionHeight?0<a&&r<=0?(i=t.top+a+e.collisionHeight-n-s,t.top+=a-i):t.top=!(0<r&&a<=0)&&r<a?s+n-e.collisionHeight:s:0<a?t.top+=a:0<r?t.top-=r:t.top=x(t.top-o,t.top)}},flip:{left:function(t,e){var i=e.within,s=i.offset.left+i.scrollLeft,n=i.width,i=i.isWindow?i.scrollLeft:i.offset.left,o=t.left-e.collisionPosition.marginLeft,a=o-i,o=o+e.collisionWidth-n-i,r="left"===e.my[0]?-e.elemWidth:"right"===e.my[0]?e.elemWidth:0,l="left"===e.at[0]?e.targetWidth:"right"===e.at[0]?-e.targetWidth:0,h=-2*e.offset[0];a<0?((n=t.left+r+l+h+e.collisionWidth-n-s)<0||n<k(a))&&(t.left+=r+l+h):0<o&&(0<(s=t.left-e.collisionPosition.marginLeft+r+l+h-i)||k(s)<o)&&(t.left+=r+l+h)},top:function(t,e){var i=e.within,s=i.offset.top+i.scrollTop,n=i.height,i=i.isWindow?i.scrollTop:i.offset.top,o=t.top-e.collisionPosition.marginTop,a=o-i,o=o+e.collisionHeight-n-i,r="top"===e.my[1]?-e.elemHeight:"bottom"===e.my[1]?e.elemHeight:0,l="top"===e.at[1]?e.targetHeight:"bottom"===e.at[1]?-e.targetHeight:0,h=-2*e.offset[1];a<0?((n=t.top+r+l+h+e.collisionHeight-n-s)<0||n<k(a))&&(t.top+=r+l+h):0<o&&(0<(s=t.top-e.collisionPosition.marginTop+r+l+h-i)||k(s)<o)&&(t.top+=r+l+h)}},flipfit:{left:function(){V.ui.position.flip.left.apply(this,arguments),V.ui.position.fit.left.apply(this,arguments)},top:function(){V.ui.position.flip.top.apply(this,arguments),V.ui.position.fit.top.apply(this,arguments)}}};V.ui.position,V.extend(V.expr.pseudos,{data:V.expr.createPseudo(function(e){return function(t){return!!V.data(t,e)}})}),V.fn.extend({disableSelection:(t="onselectstart"in document.createElement("div")?"selectstart":"mousedown",function(){return this.on(t+".ui-disableSelection",function(t){t.preventDefault()})}),enableSelection:function(){return this.off(".ui-disableSelection")}});var t,u=V,d={},W=d.toString,F=/^([\-+])=\s*(\d+\.?\d*)/,L=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(t){return[t[1],t[2],t[3],t[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(t){return[2.55*t[1],2.55*t[2],2.55*t[3],t[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})?/,parse:function(t){return[parseInt(t[1],16),parseInt(t[2],16),parseInt(t[3],16),t[4]?(parseInt(t[4],16)/255).toFixed(2):1]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])([a-f0-9])?/,parse:function(t){return[parseInt(t[1]+t[1],16),parseInt(t[2]+t[2],16),parseInt(t[3]+t[3],16),t[4]?(parseInt(t[4]+t[4],16)/255).toFixed(2):1]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(t){return[t[1],t[2]/100,t[3]/100,t[4]]}}],p=u.Color=function(t,e,i,s){return new u.Color.fn.parse(t,e,i,s)},f={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},R={byte:{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},g=u.each;function m(t){return null==t?t+"":"object"==typeof t?d[W.call(t)]||"object":typeof t}function _(t,e,i){var s=R[e.type]||{};return null==t?i||!e.def?null:e.def:(t=s.floor?~~t:parseFloat(t),s.mod?(t+s.mod)%s.mod:Math.min(s.max,Math.max(0,t)))}function Y(s){var n=p(),o=n._rgba=[];return s=s.toLowerCase(),g(L,function(t,e){var i=e.re.exec(s),i=i&&e.parse(i),e=e.space||"rgba";if(i)return i=n[e](i),n[f[e].cache]=i[f[e].cache],o=n._rgba=i._rgba,!1}),o.length?("0,0,0,0"===o.join()&&u.extend(o,y.transparent),n):y[s]}function v(t,e,i){return 6*(i=(i+1)%1)<1?t+(e-t)*i*6:2*i<1?e:3*i<2?t+(e-t)*(2/3-i)*6:t}g(f,function(t,e){e.cache="_"+t,e.props.alpha={idx:3,type:"percent",def:1}}),u.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "),function(t,e){d["[object "+e+"]"]=e.toLowerCase()}),p.fn=u.extend(p.prototype,{parse:function(n,t,e,i){if(void 0===n)return this._rgba=[null,null,null,null],this;(n.jquery||n.nodeType)&&(n=u(n).css(t),t=void 0);var o=this,s=m(n),a=this._rgba=[];return void 0!==t&&(n=[n,t,e,i],s="array"),"string"===s?this.parse(Y(n)||y._default):"array"===s?(g(f.rgba.props,function(t,e){a[e.idx]=_(n[e.idx],e)}),this):"object"===s?(n instanceof p?g(f,function(t,e){n[e.cache]&&(o[e.cache]=n[e.cache].slice())}):g(f,function(t,i){var s=i.cache;g(i.props,function(t,e){if(!o[s]&&i.to){if("alpha"===t||null==n[t])return;o[s]=i.to(o._rgba)}o[s][e.idx]=_(n[t],e,!0)}),o[s]&&u.inArray(null,o[s].slice(0,3))<0&&(null==o[s][3]&&(o[s][3]=1),i.from)&&(o._rgba=i.from(o[s]))}),this):void 0},is:function(t){var n=p(t),o=!0,a=this;return g(f,function(t,e){var i,s=n[e.cache];return s&&(i=a[e.cache]||e.to&&e.to(a._rgba)||[],g(e.props,function(t,e){if(null!=s[e.idx])return o=s[e.idx]===i[e.idx]})),o}),o},_space:function(){var i=[],s=this;return g(f,function(t,e){s[e.cache]&&i.push(t)}),i.pop()},transition:function(t,a){var t=(h=p(t))._space(),e=f[t],i=0===this.alpha()?p("transparent"):this,r=i[e.cache]||e.to(i._rgba),l=r.slice(),h=h[e.cache];return g(e.props,function(t,e){var i=e.idx,s=r[i],n=h[i],o=R[e.type]||{};null!==n&&(null===s?l[i]=n:(o.mod&&(n-s>o.mod/2?s+=o.mod:s-n>o.mod/2&&(s-=o.mod)),l[i]=_((n-s)*a+s,e)))}),this[t](l)},blend:function(t){var e,i,s;return 1===this._rgba[3]?this:(e=this._rgba.slice(),i=e.pop(),s=p(t)._rgba,p(u.map(e,function(t,e){return(1-i)*s[e]+i*t})))},toRgbaString:function(){var t="rgba(",e=u.map(this._rgba,function(t,e){return null!=t?t:2<e?1:0});return 1===e[3]&&(e.pop(),t="rgb("),t+e.join(", ")+")"},toHslaString:function(){var t="hsla(",e=u.map(this.hsla(),function(t,e){return null==t&&(t=2<e?1:0),t=e&&e<3?Math.round(100*t)+"%":t});return 1===e[3]&&(e.pop(),t="hsl("),t+e.join(", ")+")"},toHexString:function(t){var e=this._rgba.slice(),i=e.pop();return t&&e.push(~~(255*i)),"#"+u.map(e,function(t){return("0"+(t||0).toString(16)).substr(-2)}).join("")},toString:function(){return this.toRgbaString()}}),p.fn.parse.prototype=p.fn,f.hsla.to=function(t){var e,i,s,n,o,a,r,l;return null==t[0]||null==t[1]||null==t[2]?[null,null,null,t[3]]:(e=t[0]/255,i=t[1]/255,s=t[2]/255,t=t[3],n=(l=Math.max(e,i,s))-(r=Math.min(e,i,s)),a=.5*(o=l+r),r=r===l?0:e===l?60*(i-s)/n+360:i===l?60*(s-e)/n+120:60*(e-i)/n+240,l=0==n?0:a<=.5?n/o:n/(2-o),[Math.round(r)%360,l,a,null==t?1:t])},f.hsla.from=function(t){var e,i,s;return null==t[0]||null==t[1]||null==t[2]?[null,null,null,t[3]]:(e=t[0]/360,s=t[1],i=t[3],s=2*(t=t[2])-(t=t<=.5?t*(1+s):t+s-t*s),[Math.round(255*v(s,t,e+1/3)),Math.round(255*v(s,t,e)),Math.round(255*v(s,t,e-1/3)),i])},g(f,function(r,t){var e=t.props,o=t.cache,a=t.to,l=t.from;p.fn[r]=function(t){var i,s,n;return a&&!this[o]&&(this[o]=a(this._rgba)),void 0===t?this[o].slice():(i=m(t),s="array"===i||"object"===i?t:arguments,n=this[o].slice(),g(e,function(t,e){t=s["object"===i?t:e.idx];null==t&&(t=n[e.idx]),n[e.idx]=_(t,e)}),l?((t=p(l(n)))[o]=n,t):p(n))},g(e,function(o,a){p.fn[o]||(p.fn[o]=function(t){var e=m(t),i="alpha"===o?this._hsla?"hsla":"rgba":r,s=this[i](),n=s[a.idx];return"undefined"===e?n:("function"===e&&(e=m(t=t.call(this,n))),null==t&&a.empty?this:("string"===e&&(e=F.exec(t))&&(t=n+parseFloat(e[2])*("+"===e[1]?1:-1)),s[a.idx]=t,this[i](s)))})})}),p.hook=function(t){t=t.split(" ");g(t,function(t,s){u.cssHooks[s]={set:function(t,e){var i;"transparent"===e||"string"===m(e)&&!(i=Y(e))||(e=(e=p(i||e)).toRgbaString()),t.style[s]=e}},u.fx.step[s]=function(t){t.colorInit||(t.start=p(t.elem,s),t.end=p(t.end),t.colorInit=!0),u.cssHooks[s].set(t.elem,t.start.transition(t.end,t.pos))}})},p.hook("backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor"),u.cssHooks.borderColor={expand:function(i){var s={};return g(["Top","Right","Bottom","Left"],function(t,e){s["border"+e+"Color"]=i}),s}};var B,j,q,K,U,X,$,G,Q,b,y=u.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"},w="ui-effects-",e="ui-effects-style",T="ui-effects-animated";function J(t){for(var e,i=t.ownerDocument.defaultView.getComputedStyle(t),s={},n=i.length;n--;)"string"==typeof i[e=i[n]]&&(s[e.replace(/-([\da-z])/gi,function(t,e){return e.toUpperCase()})]=i[e]);return s}function P(t,e,i,s){return t={effect:t=V.isPlainObject(t)?(e=t).effect:t},"function"==typeof(e=null==e?{}:e)&&(s=e,i=null,e={}),"number"!=typeof e&&!V.fx.speeds[e]||(s=i,i=e,e={}),"function"==typeof i&&(s=i,i=null),e&&V.extend(t,e),i=i||e.duration,t.duration=V.fx.off?0:"number"==typeof i?i:i in V.fx.speeds?V.fx.speeds[i]:V.fx.speeds._default,t.complete=s||e.complete,t}function M(t){return!t||"number"==typeof t||V.fx.speeds[t]||"string"==typeof t&&!V.effects.effect[t]||"function"==typeof t||"object"==typeof t&&!t.effect}function Z(t,e){var i=e.outerWidth(),e=e.outerHeight(),t=/^rect\((-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto)\)$/.exec(t)||["",0,i,e,0];return{top:parseFloat(t[1])||0,right:"auto"===t[2]?i:parseFloat(t[2]),bottom:"auto"===t[3]?e:parseFloat(t[3]),left:parseFloat(t[4])||0}}V.effects={effect:{}},K=["add","remove","toggle"],U={border:1,borderBottom:1,borderColor:1,borderLeft:1,borderRight:1,borderTop:1,borderWidth:1,margin:1,padding:1},V.each(["borderLeftStyle","borderRightStyle","borderBottomStyle","borderTopStyle"],function(t,e){V.fx.step[e]=function(t){("none"!==t.end&&!t.setAttr||1===t.pos&&!t.setAttr)&&(u.style(t.elem,e,t.end),t.setAttr=!0)}}),V.effects.animateClass=function(n,t,e,i){var o=V.speed(t,e,i);return this.queue(function(){var i=V(this),t=i.attr("class")||"",e=(e=o.children?i.find("*").addBack():i).map(function(){return{el:V(this),start:J(this)}}),s=function(){V.each(K,function(t,e){n[e]&&i[e+"Class"](n[e])})};s(),e=e.map(function(){return this.end=J(this.el[0]),this.diff=((t,e)=>{var i,s,n={};for(i in e)s=e[i],t[i]===s||U[i]||!V.fx.step[i]&&isNaN(parseFloat(s))||(n[i]=s);return n})(this.start,this.end),this}),i.attr("class",t),e=e.map(function(){var t=this,e=V.Deferred(),i=V.extend({},o,{queue:!1,complete:function(){e.resolve(t)}});return this.el.animate(this.diff,i),e.promise()}),V.when.apply(V,e.get()).done(function(){s(),V.each(arguments,function(){var e=this.el;V.each(this.diff,function(t){e.css(t,"")})}),o.complete.call(i[0])})})},V.fn.extend({addClass:(q=V.fn.addClass,function(t,e,i,s){return e?V.effects.animateClass.call(this,{add:t},e,i,s):q.apply(this,arguments)}),removeClass:(j=V.fn.removeClass,function(t,e,i,s){return 1<arguments.length?V.effects.animateClass.call(this,{remove:t},e,i,s):j.apply(this,arguments)}),toggleClass:(B=V.fn.toggleClass,function(t,e,i,s,n){return"boolean"==typeof e||void 0===e?i?V.effects.animateClass.call(this,e?{add:t}:{remove:t},i,s,n):B.apply(this,arguments):V.effects.animateClass.call(this,{toggle:t},e,i,s)}),switchClass:function(t,e,i,s,n){return V.effects.animateClass.call(this,{add:e,remove:t},i,s,n)}}),V.expr&&V.expr.pseudos&&V.expr.pseudos.animated&&(V.expr.pseudos.animated=(X=V.expr.pseudos.animated,function(t){return!!V(t).data(T)||X(t)})),!0===V.uiBackCompat&&V.extend(V.effects,{save:function(t,e){for(var i=0,s=e.length;i<s;i++)null!==e[i]&&t.data(w+e[i],t[0].style[e[i]])},restore:function(t,e){for(var i,s=0,n=e.length;s<n;s++)null!==e[s]&&(i=t.data(w+e[s]),t.css(e[s],i))},setMode:function(t,e){return e="toggle"===e?t.is(":hidden")?"show":"hide":e},createWrapper:function(i){if(i.parent().is(".ui-effects-wrapper"))return i.parent();var s={width:i.outerWidth(!0),height:i.outerHeight(!0),float:i.css("float")},t=V("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),e={width:i.width(),height:i.height()},n=document.activeElement;try{n.id}catch(t){n=document.body}return i.wrap(t),i[0]!==n&&!V.contains(i[0],n)||V(n).trigger("focus"),t=i.parent(),"static"===i.css("position")?(t.css({position:"relative"}),i.css({position:"relative"})):(V.extend(s,{position:i.css("position"),zIndex:i.css("z-index")}),V.each(["top","left","bottom","right"],function(t,e){s[e]=i.css(e),isNaN(parseInt(s[e],10))&&(s[e]="auto")}),i.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})),i.css(e),t.css(s).show()},removeWrapper:function(t){var e=document.activeElement;return t.parent().is(".ui-effects-wrapper")&&(t.parent().replaceWith(t),t[0]!==e&&!V.contains(t[0],e)||V(e).trigger("focus")),t}}),V.extend(V.effects,{version:"1.14.1",define:function(t,e,i){return i||(i=e,e="effect"),V.effects.effect[t]=i,V.effects.effect[t].mode=e,i},scaledDimensions:function(t,e,i){var s;return 0===e?{height:0,width:0,outerHeight:0,outerWidth:0}:(s="horizontal"!==i?(e||100)/100:1,i="vertical"!==i?(e||100)/100:1,{height:t.height()*i,width:t.width()*s,outerHeight:t.outerHeight()*i,outerWidth:t.outerWidth()*s})},clipToBox:function(t){return{width:t.clip.right-t.clip.left,height:t.clip.bottom-t.clip.top,left:t.clip.left,top:t.clip.top}},unshift:function(t,e,i){var s=t.queue();1<e&&s.splice.apply(s,[1,0].concat(s.splice(e,i))),t.dequeue()},saveStyle:function(t){t.data(e,t[0].style.cssText)},restoreStyle:function(t){t[0].style.cssText=t.data(e)||"",t.removeData(e)},mode:function(t,e){t=t.is(":hidden");return"toggle"===e&&(e=t?"show":"hide"),e=(t?"hide"===e:"show"===e)?"none":e},getBaseline:function(t,e){var i,s;switch(t[0]){case"top":i=0;break;case"middle":i=.5;break;case"bottom":i=1;break;default:i=t[0]/e.height}switch(t[1]){case"left":s=0;break;case"center":s=.5;break;case"right":s=1;break;default:s=t[1]/e.width}return{x:s,y:i}},createPlaceholder:function(t){var e,i=t.css("position"),s=t.position();return t.css({marginTop:t.css("marginTop"),marginBottom:t.css("marginBottom"),marginLeft:t.css("marginLeft"),marginRight:t.css("marginRight")}).outerWidth(t.outerWidth()).outerHeight(t.outerHeight()),/^(static|relative)/.test(i)&&(i="absolute",e=V("<"+t[0].nodeName+">").insertAfter(t).css({display:/^(inline|ruby)/.test(t.css("display"))?"inline-block":"block",visibility:"hidden",marginTop:t.css("marginTop"),marginBottom:t.css("marginBottom"),marginLeft:t.css("marginLeft"),marginRight:t.css("marginRight"),float:t.css("float")}).outerWidth(t.outerWidth()).outerHeight(t.outerHeight()).addClass("ui-effects-placeholder"),t.data(w+"placeholder",e)),t.css({position:i,left:s.left,top:s.top}),e},removePlaceholder:function(t){var e=w+"placeholder",i=t.data(e);i&&(i.remove(),t.removeData(e))},cleanUp:function(t){V.effects.restoreStyle(t),V.effects.removePlaceholder(t)},setTransition:function(s,t,n,o){return o=o||{},V.each(t,function(t,e){var i=s.cssUnit(e);0<i[0]&&(o[e]=i[0]*n+i[1])}),o}}),V.fn.extend({effect:function(){function t(t){var e=V(this),i=V.effects.mode(e,r)||o;e.data(T,!0),l.push(i),o&&("show"===i||i===o&&"hide"===i)&&e.show(),o&&"none"===i||V.effects.saveStyle(e),"function"==typeof t&&t()}var s=P.apply(this,arguments),n=V.effects.effect[s.effect],o=n.mode,e=s.queue,i=e||"fx",a=s.complete,r=s.mode,l=[];return V.fx.off||!n?r?this[r](s.duration,a):this.each(function(){a&&a.call(this)}):!1===e?this.each(t).each(h):this.queue(i,t).queue(i,h);function h(t){var e=V(this);function i(){"function"==typeof a&&a.call(e[0]),"function"==typeof t&&t()}s.mode=l.shift(),!0!==V.uiBackCompat||o?"none"===s.mode?(e[r](),i()):n.call(e[0],s,function(){e.removeData(T),V.effects.cleanUp(e),"hide"===s.mode&&e.hide(),i()}):(e.is(":hidden")?"hide"===r:"show"===r)?(e[r](),i()):n.call(e[0],s,i)}},show:(Q=V.fn.show,function(t){return M(t)?Q.apply(this,arguments):((t=P.apply(this,arguments)).mode="show",this.effect.call(this,t))}),hide:(G=V.fn.hide,function(t){return M(t)?G.apply(this,arguments):((t=P.apply(this,arguments)).mode="hide",this.effect.call(this,t))}),toggle:($=V.fn.toggle,function(t){return M(t)||"boolean"==typeof t?$.apply(this,arguments):((t=P.apply(this,arguments)).mode="toggle",this.effect.call(this,t))}),cssUnit:function(t){var i=this.css(t),s=[];return V.each(["em","px","%","pt"],function(t,e){0<i.indexOf(e)&&(s=[parseFloat(i),e])}),s},cssClip:function(t){return t?this.css("clip","rect("+t.top+"px "+t.right+"px "+t.bottom+"px "+t.left+"px)"):Z(this.css("clip"),this)},transfer:function(t,e){var i=V(this),s=V(t.to),n="fixed"===s.css("position"),o=V("body"),a=n?o.scrollTop():0,o=n?o.scrollLeft():0,r=s.offset(),r={top:r.top-a,left:r.left-o,height:s.innerHeight(),width:s.innerWidth()},s=i.offset(),l=V("<div class='ui-effects-transfer'></div>");l.appendTo("body").addClass(t.className).css({top:s.top-a,left:s.left-o,height:i.innerHeight(),width:i.innerWidth(),position:n?"fixed":"absolute"}).animate(r,t.duration,t.easing,function(){l.remove(),"function"==typeof e&&e()})}}),V.fx.step.clip=function(t){t.clipInit||(t.start=V(t.elem).cssClip(),"string"==typeof t.end&&(t.end=Z(t.end,t.elem)),t.clipInit=!0),V(t.elem).cssClip({top:t.pos*(t.end.top-t.start.top)+t.start.top,right:t.pos*(t.end.right-t.start.right)+t.start.right,bottom:t.pos*(t.end.bottom-t.start.bottom)+t.start.bottom,left:t.pos*(t.end.left-t.start.left)+t.start.left})},b={},V.each(["Quad","Cubic","Quart","Quint","Expo"],function(e,t){b[t]=function(t){return Math.pow(t,e+2)}}),V.extend(b,{Sine:function(t){return 1-Math.cos(t*Math.PI/2)},Circ:function(t){return 1-Math.sqrt(1-t*t)},Elastic:function(t){return 0===t||1===t?t:-Math.pow(2,8*(t-1))*Math.sin((80*(t-1)-7.5)*Math.PI/15)},Back:function(t){return t*t*(3*t-2)},Bounce:function(t){for(var e,i=4;t<((e=Math.pow(2,--i))-1)/11;);return 1/Math.pow(4,3-i)-7.5625*Math.pow((3*e-2)/22-t,2)}}),V.each(b,function(t,e){V.easing["easeIn"+t]=e,V.easing["easeOut"+t]=function(t){return 1-e(1-t)},V.easing["easeInOut"+t]=function(t){return t<.5?e(2*t)/2:1-e(-2*t+2)/2}});var tt,et,S,it=V.effects,st=(V.effects.define("blind","hide",function(t,e){var i={up:["bottom","top"],vertical:["bottom","top"],down:["top","bottom"],left:["right","left"],horizontal:["right","left"],right:["left","right"]},s=V(this),n=t.direction||"up",o=s.cssClip(),a={clip:V.extend({},o)},r=V.effects.createPlaceholder(s);a.clip[i[n][0]]=a.clip[i[n][1]],"show"===t.mode&&(s.cssClip(a.clip),r&&r.css(V.effects.clipToBox(a)),a.clip=o),r&&r.animate(V.effects.clipToBox(a),t.duration,t.easing),s.animate(a,{queue:!1,duration:t.duration,easing:t.easing,complete:e})}),V.effects.define("bounce",function(t,e){var i,s,n=V(this),o=t.mode,a="hide"===o,o="show"===o,r=t.direction||"up",l=t.distance,h=t.times||5,c=2*h+(o||a?1:0),u=t.duration/c,d=t.easing,p="up"===r||"down"===r?"top":"left",f="up"===r||"left"===r,g=0,t=n.queue().length;for(V.effects.createPlaceholder(n),r=n.css(p),l=l||n["top"==p?"outerHeight":"outerWidth"]()/3,o&&((s={opacity:1})[p]=r,n.css("opacity",0).css(p,f?2*-l:2*l).animate(s,u,d)),a&&(l/=Math.pow(2,h-1)),(s={})[p]=r;g<h;g++)(i={})[p]=(f?"-=":"+=")+l,n.animate(i,u,d).animate(s,u,d),l=a?2*l:l/2;a&&((i={opacity:0})[p]=(f?"-=":"+=")+l,n.animate(i,u,d)),n.queue(e),V.effects.unshift(n,t,1+c)}),V.effects.define("clip","hide",function(t,e){var i={},s=V(this),n=t.direction||"vertical",o="both"===n,a=o||"horizontal"===n,o=o||"vertical"===n,n=s.cssClip();i.clip={top:o?(n.bottom-n.top)/2:n.top,right:a?(n.right-n.left)/2:n.right,bottom:o?(n.bottom-n.top)/2:n.bottom,left:a?(n.right-n.left)/2:n.left},V.effects.createPlaceholder(s),"show"===t.mode&&(s.cssClip(i.clip),i.clip=n),s.animate(i,{queue:!1,duration:t.duration,easing:t.easing,complete:e})}),V.effects.define("drop","hide",function(t,e){var i,s=V(this),n="show"===t.mode,o=t.direction||"left",a="up"===o||"down"===o?"top":"left",o="up"===o||"left"===o?"-=":"+=",r="+="==o?"-=":"+=",l={opacity:0};V.effects.createPlaceholder(s),i=t.distance||s["top"==a?"outerHeight":"outerWidth"](!0)/2,l[a]=o+i,n&&(s.css(l),l[a]=r+i,l.opacity=1),s.animate(l,{queue:!1,duration:t.duration,easing:t.easing,complete:e})}),V.effects.define("explode","hide",function(t,e){var i,s,n,o,a,r,l=t.pieces?Math.round(Math.sqrt(t.pieces)):3,h=l,c=V(this),u="show"===t.mode,d=c.show().css("visibility","hidden").offset(),p=Math.ceil(c.outerWidth()/h),f=Math.ceil(c.outerHeight()/l),g=[];function m(){g.push(this),g.length===l*h&&(c.css({visibility:"visible"}),V(g).remove(),e())}for(i=0;i<l;i++)for(o=d.top+i*f,r=i-(l-1)/2,s=0;s<h;s++)n=d.left+s*p,a=s-(h-1)/2,c.clone().appendTo("body").wrap("<div></div>").css({position:"absolute",visibility:"visible",left:-s*p,top:-i*f}).parent().addClass("ui-effects-explode").css({position:"absolute",overflow:"hidden",width:p,height:f,left:n+(u?a*p:0),top:o+(u?r*f:0),opacity:u?0:1}).animate({left:n+(u?0:a*p),top:o+(u?0:r*f),opacity:u?1:0},t.duration||500,t.easing,m)}),V.effects.define("fade","toggle",function(t,e){var i="show"===t.mode;V(this).css("opacity",i?0:1).animate({opacity:i?1:0},{queue:!1,duration:t.duration,easing:t.easing,complete:e})}),V.effects.define("fold","hide",function(e,t){var i=V(this),s=e.mode,n="show"===s,s="hide"===s,o=e.size||15,a=/([0-9]+)%/.exec(o),r=!!e.horizFirst?["right","bottom"]:["bottom","right"],l=e.duration/2,h=V.effects.createPlaceholder(i),c=i.cssClip(),u={clip:V.extend({},c)},d={clip:V.extend({},c)},p=[c[r[0]],c[r[1]]],f=i.queue().length;a&&(o=parseInt(a[1],10)/100*p[s?0:1]),u.clip[r[0]]=o,d.clip[r[0]]=o,d.clip[r[1]]=0,n&&(i.cssClip(d.clip),h&&h.css(V.effects.clipToBox(d)),d.clip=c),i.queue(function(t){h&&h.animate(V.effects.clipToBox(u),l,e.easing).animate(V.effects.clipToBox(d),l,e.easing),t()}).animate(u,l,e.easing).animate(d,l,e.easing).queue(t),V.effects.unshift(i,f,4)}),V.effects.define("highlight","show",function(t,e){var i=V(this),s={backgroundColor:i.css("backgroundColor")};"hide"===t.mode&&(s.opacity=0),V.effects.saveStyle(i),i.css({backgroundImage:"none",backgroundColor:t.color||"#ffff99"}).animate(s,{queue:!1,duration:t.duration,easing:t.easing,complete:e})}),V.effects.define("size",function(s,e){var n,i=V(this),t=["fontSize"],o=["borderTopWidth","borderBottomWidth","paddingTop","paddingBottom"],a=["borderLeftWidth","borderRightWidth","paddingLeft","paddingRight"],r=s.mode,l="effect"!==r,h=s.scale||"both",c=s.origin||["middle","center"],u=i.css("position"),d=i.position(),p=V.effects.scaledDimensions(i),f=s.from||p,g=s.to||V.effects.scaledDimensions(i,0);V.effects.createPlaceholder(i),"show"===r&&(r=f,f=g,g=r),n={from:{y:f.height/p.height,x:f.width/p.width},to:{y:g.height/p.height,x:g.width/p.width}},"box"!==h&&"both"!==h||(n.from.y!==n.to.y&&(f=V.effects.setTransition(i,o,n.from.y,f),g=V.effects.setTransition(i,o,n.to.y,g)),n.from.x!==n.to.x&&(f=V.effects.setTransition(i,a,n.from.x,f),g=V.effects.setTransition(i,a,n.to.x,g))),"content"!==h&&"both"!==h||n.from.y!==n.to.y&&(f=V.effects.setTransition(i,t,n.from.y,f),g=V.effects.setTransition(i,t,n.to.y,g)),c&&(r=V.effects.getBaseline(c,p),f.top=(p.outerHeight-f.outerHeight)*r.y+d.top,f.left=(p.outerWidth-f.outerWidth)*r.x+d.left,g.top=(p.outerHeight-g.outerHeight)*r.y+d.top,g.left=(p.outerWidth-g.outerWidth)*r.x+d.left),delete f.outerHeight,delete f.outerWidth,i.css(f),"content"!==h&&"both"!==h||(o=o.concat(["marginTop","marginBottom"]).concat(t),a=a.concat(["marginLeft","marginRight"]),i.find("*[width]").each(function(){var t=V(this),e=V.effects.scaledDimensions(t),i={height:e.height*n.from.y,width:e.width*n.from.x,outerHeight:e.outerHeight*n.from.y,outerWidth:e.outerWidth*n.from.x},e={height:e.height*n.to.y,width:e.width*n.to.x,outerHeight:e.height*n.to.y,outerWidth:e.width*n.to.x};n.from.y!==n.to.y&&(i=V.effects.setTransition(t,o,n.from.y,i),e=V.effects.setTransition(t,o,n.to.y,e)),n.from.x!==n.to.x&&(i=V.effects.setTransition(t,a,n.from.x,i),e=V.effects.setTransition(t,a,n.to.x,e)),l&&V.effects.saveStyle(t),t.css(i),t.animate(e,s.duration,s.easing,function(){l&&V.effects.restoreStyle(t)})})),i.animate(g,{queue:!1,duration:s.duration,easing:s.easing,complete:function(){var t=i.offset();0===g.opacity&&i.css("opacity",f.opacity),l||(i.css("position","static"===u?"relative":u).offset(t),V.effects.saveStyle(i)),e()}})}),V.effects.define("scale",function(t,e){var i=V(this),s=t.mode,s=parseInt(t.percent,10)||(0===parseInt(t.percent,10)||"effect"!==s?0:100),i=V.extend(!0,{from:V.effects.scaledDimensions(i),to:V.effects.scaledDimensions(i,s,t.direction||"both"),origin:t.origin||["middle","center"]},t);t.fade&&(i.from.opacity=1,i.to.opacity=0),V.effects.effect.size.call(this,i,e)}),V.effects.define("puff","hide",function(t,e){t=V.extend(!0,{},t,{fade:!0,percent:parseInt(t.percent,10)||150});V.effects.effect.scale.call(this,t,e)}),V.effects.define("pulsate","show",function(t,e){var i=V(this),s=t.mode,n="show"===s,o=2*(t.times||5)+(n||"hide"===s?1:0),a=t.duration/o,r=0,l=1,s=i.queue().length;for(!n&&i.is(":visible")||(i.css("opacity",0).show(),r=1);l<o;l++)i.animate({opacity:r},a,t.easing),r=1-r;i.animate({opacity:r},a,t.easing),i.queue(e),V.effects.unshift(i,s,1+o)}),V.effects.define("shake",function(t,e){var i=1,s=V(this),n=t.direction||"left",o=t.distance||20,a=t.times||3,r=2*a+1,l=Math.round(t.duration/r),h="up"===n||"down"===n?"top":"left",n="up"===n||"left"===n,c={},u={},d={},p=s.queue().length;for(V.effects.createPlaceholder(s),c[h]=(n?"-=":"+=")+o,u[h]=(n?"+=":"-=")+2*o,d[h]=(n?"-=":"+=")+2*o,s.animate(c,l,t.easing);i<a;i++)s.animate(u,l,t.easing).animate(d,l,t.easing);s.animate(u,l,t.easing).animate(c,l/2,t.easing).queue(e),V.effects.unshift(s,p,1+r)}),V.effects.define("slide","show",function(t,e){var i,s,n=V(this),o={up:["bottom","top"],down:["top","bottom"],left:["right","left"],right:["left","right"]},a=t.mode,r=t.direction||"left",l="up"===r||"down"===r?"top":"left",h="up"===r||"left"===r,c=t.distance||n["top"==l?"outerHeight":"outerWidth"](!0),u={};V.effects.createPlaceholder(n),i=n.cssClip(),s=n.position()[l],u[l]=(h?-1:1)*c+s,u.clip=n.cssClip(),u.clip[o[r][1]]=u.clip[o[r][0]],"show"===a&&(n.cssClip(u.clip),n.css(l,u[l]),u.clip=i,u[l]=s),n.animate(u,{queue:!1,duration:t.duration,easing:t.easing,complete:e})}),it=!0===V.uiBackCompat?V.effects.define("transfer",function(t,e){V(this).transfer(t,e)}):it,V.ui.focusable=function(t,e){var i,s,n,o=t.nodeName.toLowerCase();return"area"===o?(n=(i=t.parentNode).name,!(!t.href||!n||"map"!==i.nodeName.toLowerCase())&&0<(i=V("img[usemap='#"+n+"']")).length&&i.is(":visible")):(/^(input|select|textarea|button|object)$/.test(o)?(s=!t.disabled)&&(n=V(t).closest("fieldset")[0])&&(s=!n.disabled):s="a"===o&&t.href||e,s&&V(t).is(":visible")&&"visible"===V(t).css("visibility"))},V.extend(V.expr.pseudos,{focusable:function(t){return V.ui.focusable(t,null!=V.attr(t,"tabindex"))}}),V.ui.focusable,V.ui.formResetMixin={_formResetHandler:function(){var e=V(this);setTimeout(function(){var t=e.data("ui-form-reset-instances");V.each(t,function(){this.refresh()})})},_bindFormResetHandler:function(){var t;this.form=V(this.element.prop("form")),this.form.length&&((t=this.form.data("ui-form-reset-instances")||[]).length||this.form.on("reset.ui-form-reset",this._formResetHandler),t.push(this),this.form.data("ui-form-reset-instances",t))},_unbindFormResetHandler:function(){var t;this.form.length&&((t=this.form.data("ui-form-reset-instances")).splice(V.inArray(this,t),1),t.length?this.form.data("ui-form-reset-instances",t):this.form.removeData("ui-form-reset-instances").off("reset.ui-form-reset"))}},V.escapeSelector||(V.escapeSelector=function(t){return CSS.escape(t+"")}),V.fn.even&&V.fn.odd||V.fn.extend({even:function(){return this.filter(function(t){return t%2==0})},odd:function(){return this.filter(function(t){return t%2==1})}}),V.ui.keyCode={BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38},V.fn.labels=function(){var t,e,i;return this.length?this[0].labels&&this[0].labels.length?this.pushStack(this[0].labels):(e=this.eq(0).parents("label"),(t=this.attr("id"))&&(i=(i=this.eq(0).parents().last()).add((i.length?i:this).siblings()),t="label[for='"+CSS.escape(t)+"']",e=e.add(i.find(t).addBack(t))),this.pushStack(e)):this.pushStack([])},V.fn.scrollParent=function(t){var e=this.css("position"),i="absolute"===e,s=t?/(auto|scroll|hidden)/:/(auto|scroll)/,t=this.parents().filter(function(){var t=V(this);return(!i||"static"!==t.css("position"))&&s.test(t.css("overflow")+t.css("overflow-y")+t.css("overflow-x"))}).eq(0);return"fixed"!==e&&t.length?t:V(this[0].ownerDocument||document)},V.extend(V.expr.pseudos,{tabbable:function(t){var e=V.attr(t,"tabindex"),i=null!=e;return(!i||0<=e)&&V.ui.focusable(t,i)}}),V.fn.extend({uniqueId:(tt=0,function(){return this.each(function(){this.id||(this.id="ui-id-"+ ++tt)})}),removeUniqueId:function(){return this.each(function(){/^ui-id-\d+$/.test(this.id)&&V(this).removeAttr("id")})}}),V.widget("ui.accordion",{version:"1.14.1",options:{active:0,animate:{},classes:{"ui-accordion-header":"ui-corner-top","ui-accordion-header-collapsed":"ui-corner-all","ui-accordion-content":"ui-corner-bottom"},collapsible:!1,event:"click",header:function(t){return t.find("> li > :first-child").add(t.find("> :not(li)").filter(function(t){return t%2==0}))},heightStyle:"auto",icons:{activeHeader:"ui-icon-triangle-1-s",header:"ui-icon-triangle-1-e"},activate:null,beforeActivate:null},hideProps:{borderTopWidth:"hide",borderBottomWidth:"hide",paddingTop:"hide",paddingBottom:"hide",height:"hide"},showProps:{borderTopWidth:"show",borderBottomWidth:"show",paddingTop:"show",paddingBottom:"show",height:"show"},_create:function(){var t=this.options;this.prevShow=this.prevHide=V(),this._addClass("ui-accordion","ui-widget ui-helper-reset"),this.element.attr("role","tablist"),t.collapsible||!1!==t.active&&null!=t.active||(t.active=0),this._processPanels(),t.active<0&&(t.active+=this.headers.length),this._refresh()},_getCreateEventData:function(){return{header:this.active,panel:this.active.length?this.active.next():V()}},_createIcons:function(){var t,e=this.options.icons;e&&(t=V("<span>"),this._addClass(t,"ui-accordion-header-icon","ui-icon "+e.header),t.prependTo(this.headers),t=this.active.children(".ui-accordion-header-icon"),this._removeClass(t,e.header)._addClass(t,null,e.activeHeader)._addClass(this.headers,"ui-accordion-icons"))},_destroyIcons:function(){this._removeClass(this.headers,"ui-accordion-icons"),this.headers.children(".ui-accordion-header-icon").remove()},_destroy:function(){var t;this.element.removeAttr("role"),this.headers.removeAttr("role aria-expanded aria-selected aria-controls tabIndex").removeUniqueId(),this._destroyIcons(),t=this.headers.next().css("display","").removeAttr("role aria-hidden aria-labelledby").removeUniqueId(),"content"!==this.options.heightStyle&&t.css("height","")},_setOption:function(t,e){"active"===t?this._activate(e):("event"===t&&(this.options.event&&this._off(this.headers,this.options.event),this._setupEvents(e)),this._super(t,e),"collapsible"!==t||e||!1!==this.options.active||this._activate(0),"icons"===t&&(this._destroyIcons(),e)&&this._createIcons())},_setOptionDisabled:function(t){this._super(t),this.element.attr("aria-disabled",t),this._toggleClass(null,"ui-state-disabled",!!t)},_keydown:function(t){if(!t.altKey&&!t.ctrlKey){var e=V.ui.keyCode,i=this.headers.length,s=this.headers.index(t.target),n=!1;switch(t.keyCode){case e.RIGHT:case e.DOWN:n=this.headers[(s+1)%i];break;case e.LEFT:case e.UP:n=this.headers[(s-1+i)%i];break;case e.SPACE:case e.ENTER:this._eventHandler(t);break;case e.HOME:n=this.headers[0];break;case e.END:n=this.headers[i-1]}n&&(V(t.target).attr("tabIndex",-1),V(n).attr("tabIndex",0),V(n).trigger("focus"),t.preventDefault())}},_panelKeyDown:function(t){t.keyCode===V.ui.keyCode.UP&&t.ctrlKey&&V(t.currentTarget).prev().trigger("focus")},refresh:function(){var t=this.options;this._processPanels(),!1===t.active&&!0===t.collapsible||!this.headers.length?(t.active=!1,this.active=V()):!1===t.active?this._activate(0):this.active.length&&!V.contains(this.element[0],this.active[0])?this.headers.length===this.headers.find(".ui-state-disabled").length?(t.active=!1,this.active=V()):this._activate(Math.max(0,t.active-1)):t.active=this.headers.index(this.active),this._destroyIcons(),this._refresh()},_processPanels:function(){var t=this.headers,e=this.panels;"function"==typeof this.options.header?this.headers=this.options.header(this.element):this.headers=this.element.find(this.options.header),this._addClass(this.headers,"ui-accordion-header ui-accordion-header-collapsed","ui-state-default"),this.panels=this.headers.next().filter(":not(.ui-accordion-content-active)").hide(),this._addClass(this.panels,"ui-accordion-content","ui-helper-reset ui-widget-content"),e&&(this._off(t.not(this.headers)),this._off(e.not(this.panels)))},_refresh:function(){var i,t=this.options,e=t.heightStyle,s=this.element.parent();this.active=this._findActive(t.active),this._addClass(this.active,"ui-accordion-header-active","ui-state-active")._removeClass(this.active,"ui-accordion-header-collapsed"),this._addClass(this.active.next(),"ui-accordion-content-active"),this.active.next().show(),this.headers.attr("role","tab").each(function(){var t=V(this),e=t.uniqueId().attr("id"),i=t.next(),s=i.uniqueId().attr("id");t.attr("aria-controls",s),i.attr("aria-labelledby",e)}).next().attr("role","tabpanel"),this.headers.not(this.active).attr({"aria-selected":"false","aria-expanded":"false",tabIndex:-1}).next().attr({"aria-hidden":"true"}).hide(),this.active.length?this.active.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0}).next().attr({"aria-hidden":"false"}):this.headers.eq(0).attr("tabIndex",0),this._createIcons(),this._setupEvents(t.event),"fill"===e?(i=s.height(),this.element.siblings(":visible").each(function(){var t=V(this),e=t.css("position");"absolute"!==e&&"fixed"!==e&&(i-=t.outerHeight(!0))}),this.headers.each(function(){i-=V(this).outerHeight(!0)}),this.headers.next().each(function(){V(this).height(Math.max(0,i-V(this).innerHeight()+V(this).height()))}).css("overflow","auto")):"auto"===e&&(i=0,this.headers.next().each(function(){var t=V(this).is(":visible");t||V(this).show(),i=Math.max(i,V(this).css("height","").height()),t||V(this).hide()}).height(i))},_activate:function(t){t=this._findActive(t)[0];t!==this.active[0]&&(t=t||this.active[0],this._eventHandler({target:t,currentTarget:t,preventDefault:V.noop}))},_findActive:function(t){return"number"==typeof t?this.headers.eq(t):V()},_setupEvents:function(t){var i={keydown:"_keydown"};t&&V.each(t.split(" "),function(t,e){i[e]="_eventHandler"}),this._off(this.headers.add(this.headers.next())),this._on(this.headers,i),this._on(this.headers.next(),{keydown:"_panelKeyDown"}),this._hoverable(this.headers),this._focusable(this.headers)},_eventHandler:function(t){var e=this.options,i=this.active,s=V(t.currentTarget),n=s[0]===i[0],o=n&&e.collapsible,a=o?V():s.next(),r=i.next(),r={oldHeader:i,oldPanel:r,newHeader:o?V():s,newPanel:a};t.preventDefault(),n&&!e.collapsible||!1===this._trigger("beforeActivate",t,r)||(e.active=!o&&this.headers.index(s),this.active=n?V():s,this._toggle(r),this._removeClass(i,"ui-accordion-header-active","ui-state-active"),e.icons&&(a=i.children(".ui-accordion-header-icon"),this._removeClass(a,null,e.icons.activeHeader)._addClass(a,null,e.icons.header)),n)||(this._removeClass(s,"ui-accordion-header-collapsed")._addClass(s,"ui-accordion-header-active","ui-state-active"),e.icons&&(t=s.children(".ui-accordion-header-icon"),this._removeClass(t,null,e.icons.header)._addClass(t,null,e.icons.activeHeader)),this._addClass(s.next(),"ui-accordion-content-active"))},_toggle:function(t){var e=t.newPanel,i=this.prevShow.length?this.prevShow:t.oldPanel;this.prevShow.add(this.prevHide).stop(!0,!0),this.prevShow=e,this.prevHide=i,this.options.animate?this._animate(e,i,t):(i.hide(),e.show(),this._toggleComplete(t)),i.attr({"aria-hidden":"true"}),i.prev().attr({"aria-selected":"false","aria-expanded":"false"}),e.length&&i.length?i.prev().attr({tabIndex:-1,"aria-expanded":"false"}):e.length&&this.headers.filter(function(){return 0===parseInt(V(this).attr("tabIndex"),10)}).attr("tabIndex",-1),e.attr("aria-hidden","false").prev().attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0})},_animate:function(t,i,e){function s(){o._toggleComplete(e)}var n,o=this,a=0,r=t.css("box-sizing"),l=t.length&&(!i.length||t.index()<i.index()),h=this.options.animate||{},l=l&&h.down||h,c=(c="string"==typeof l?l:c)||l.easing||h.easing,u=(u="number"==typeof l?l:u)||l.duration||h.duration;return i.length?t.length?(n=t.show().outerHeight(),i.animate(this.hideProps,{duration:u,easing:c,step:function(t,e){e.now=Math.round(t)}}),void t.hide().animate(this.showProps,{duration:u,easing:c,complete:s,step:function(t,e){e.now=Math.round(t),"height"!==e.prop?"content-box"===r&&(a+=e.now):"content"!==o.options.heightStyle&&(e.now=Math.round(n-i.outerHeight()-a),a=0)}})):i.animate(this.hideProps,u,c,s):t.animate(this.showProps,u,c,s)},_toggleComplete:function(t){var e=t.oldPanel,i=e.prev();this._removeClass(e,"ui-accordion-content-active"),this._removeClass(i,"ui-accordion-header-active")._addClass(i,"ui-accordion-header-collapsed"),this._trigger("activate",null,t)}}),V.widget("ui.menu",{version:"1.14.1",defaultElement:"<ul>",delay:300,options:{icons:{submenu:"ui-icon-caret-1-e"},items:"> *",menus:"ul",position:{my:"left top",at:"right top"},role:"menu",blur:null,focus:null,select:null},_create:function(){this.activeMenu=this.element,this.mouseHandled=!1,this.lastMousePosition={x:null,y:null},this.element.uniqueId().attr({role:this.options.role,tabIndex:0}),this._addClass("ui-menu","ui-widget ui-widget-content"),this._on({"mousedown .ui-menu-item":function(t){t.preventDefault(),this._activateItem(t)},"click .ui-menu-item":function(t){var e=V(t.target),i=V(this.document[0].activeElement);!this.mouseHandled&&e.not(".ui-state-disabled").length&&(this.select(t),t.isPropagationStopped()||(this.mouseHandled=!0),e.has(".ui-menu").length?this.expand(t):!this.element.is(":focus")&&i.closest(".ui-menu").length&&(this.element.trigger("focus",[!0]),this.active)&&1===this.active.parents(".ui-menu").length&&clearTimeout(this.timer))},"mouseenter .ui-menu-item":"_activateItem","mousemove .ui-menu-item":"_activateItem",mouseleave:"collapseAll","mouseleave .ui-menu":"collapseAll",focus:function(t,e){var i=this.active||this._menuItems().first();e||this.focus(t,i)},blur:function(t){this._delay(function(){V.contains(this.element[0],this.document[0].activeElement)||this.collapseAll(t)})},keydown:"_keydown"}),this.refresh(),this._on(this.document,{click:function(t){this._closeOnDocumentClick(t)&&this.collapseAll(t,!0),this.mouseHandled=!1}})},_activateItem:function(t){var e,i;this.previousFilter||t.clientX===this.lastMousePosition.x&&t.clientY===this.lastMousePosition.y||(this.lastMousePosition={x:t.clientX,y:t.clientY},e=V(t.target).closest(".ui-menu-item"),i=V(t.currentTarget),e[0]!==i[0])||i.is(".ui-state-active")||(this._removeClass(i.siblings().children(".ui-state-active"),null,"ui-state-active"),this.focus(t,i))},_destroy:function(){var t=this.element.find(".ui-menu-item").removeAttr("role aria-disabled").children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled tabIndex").removeUniqueId().show(),t.children().each(function(){var t=V(this);t.data("ui-menu-submenu-caret")&&t.remove()})},_keydown:function(t){var e,i,s,n=!0;switch(t.keyCode){case V.ui.keyCode.PAGE_UP:this.previousPage(t);break;case V.ui.keyCode.PAGE_DOWN:this.nextPage(t);break;case V.ui.keyCode.HOME:this._move("first","first",t);break;case V.ui.keyCode.END:this._move("last","last",t);break;case V.ui.keyCode.UP:this.previous(t);break;case V.ui.keyCode.DOWN:this.next(t);break;case V.ui.keyCode.LEFT:this.collapse(t);break;case V.ui.keyCode.RIGHT:this.active&&!this.active.is(".ui-state-disabled")&&this.expand(t);break;case V.ui.keyCode.ENTER:case V.ui.keyCode.SPACE:this._activate(t);break;case V.ui.keyCode.ESCAPE:this.collapse(t);break;default:e=this.previousFilter||"",s=n=!1,i=96<=t.keyCode&&t.keyCode<=105?(t.keyCode-96).toString():String.fromCharCode(t.keyCode),clearTimeout(this.filterTimer),i===e?s=!0:i=e+i,e=this._filterMenuItems(i),(e=s&&-1!==e.index(this.active.next())?this.active.nextAll(".ui-menu-item"):e).length||(i=String.fromCharCode(t.keyCode),e=this._filterMenuItems(i)),e.length?(this.focus(t,e),this.previousFilter=i,this.filterTimer=this._delay(function(){delete this.previousFilter},1e3)):delete this.previousFilter}n&&t.preventDefault()},_activate:function(t){this.active&&!this.active.is(".ui-state-disabled")&&(this.active.children("[aria-haspopup='true']").length?this.expand(t):this.select(t))},refresh:function(){var t,e,s=this,n=this.options.icons.submenu,i=this.element.find(this.options.menus);this._toggleClass("ui-menu-icons",null,!!this.element.find(".ui-icon").length),t=i.filter(":not(.ui-menu)").hide().attr({role:this.options.role,"aria-hidden":"true","aria-expanded":"false"}).each(function(){var t=V(this),e=t.prev(),i=V("<span>").data("ui-menu-submenu-caret",!0);s._addClass(i,"ui-menu-icon","ui-icon "+n),e.attr("aria-haspopup","true").prepend(i),t.attr("aria-labelledby",e.attr("id"))}),this._addClass(t,"ui-menu","ui-widget ui-widget-content ui-front"),(t=i.add(this.element).find(this.options.items)).not(".ui-menu-item").each(function(){var t=V(this);s._isDivider(t)&&s._addClass(t,"ui-menu-divider","ui-widget-content")}),e=(i=t.not(".ui-menu-item, .ui-menu-divider")).children().not(".ui-menu").uniqueId().attr({tabIndex:-1,role:this._itemRole()}),this._addClass(i,"ui-menu-item")._addClass(e,"ui-menu-item-wrapper"),t.filter(".ui-state-disabled").attr("aria-disabled","true"),this.active&&!V.contains(this.element[0],this.active[0])&&this.blur()},_itemRole:function(){return{menu:"menuitem",listbox:"option"}[this.options.role]},_setOption:function(t,e){var i;"icons"===t&&(i=this.element.find(".ui-menu-icon"),this._removeClass(i,null,this.options.icons.submenu)._addClass(i,null,e.submenu)),this._super(t,e)},_setOptionDisabled:function(t){this._super(t),this.element.attr("aria-disabled",String(t)),this._toggleClass(null,"ui-state-disabled",!!t)},focus:function(t,e){var i;this.blur(t,t&&"focus"===t.type),this._scrollIntoView(e),this.active=e.first(),i=this.active.children(".ui-menu-item-wrapper"),this._addClass(i,null,"ui-state-active"),this.options.role&&this.element.attr("aria-activedescendant",i.attr("id")),i=this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper"),this._addClass(i,null,"ui-state-active"),t&&"keydown"===t.type?this._close():this.timer=this._delay(function(){this._close()},this.delay),(i=e.children(".ui-menu")).length&&t&&/^mouse/.test(t.type)&&this._startOpening(i),this.activeMenu=e.parent(),this._trigger("focus",t,{item:e})},_scrollIntoView:function(t){var e,i,s;this._hasScroll()&&(e=parseFloat(V.css(this.activeMenu[0],"borderTopWidth"))||0,i=parseFloat(V.css(this.activeMenu[0],"paddingTop"))||0,e=t.offset().top-this.activeMenu.offset().top-e-i,i=this.activeMenu.scrollTop(),s=this.activeMenu.height(),t=t.outerHeight(),e<0?this.activeMenu.scrollTop(i+e):s<e+t&&this.activeMenu.scrollTop(i+e-s+t))},blur:function(t,e){e||clearTimeout(this.timer),this.active&&(this._removeClass(this.active.children(".ui-menu-item-wrapper"),null,"ui-state-active"),this._trigger("blur",t,{item:this.active}),this.active=null)},_startOpening:function(t){clearTimeout(this.timer),"true"===t.attr("aria-hidden")&&(this.timer=this._delay(function(){this._close(),this._open(t)},this.delay))},_open:function(t){var e=V.extend({of:this.active},this.options.position);clearTimeout(this.timer),this.element.find(".ui-menu").not(t.parents(".ui-menu")).hide().attr("aria-hidden","true"),t.show().removeAttr("aria-hidden").attr("aria-expanded","true").position(e)},collapseAll:function(e,i){clearTimeout(this.timer),this.timer=this._delay(function(){var t=i?this.element:V(e&&e.target).closest(this.element.find(".ui-menu"));t.length||(t=this.element),this._close(t),this.blur(e),this._removeClass(t.find(".ui-state-active"),null,"ui-state-active"),this.activeMenu=t},i?0:this.delay)},_close:function(t){(t=t||(this.active?this.active.parent():this.element)).find(".ui-menu").hide().attr("aria-hidden","true").attr("aria-expanded","false")},_closeOnDocumentClick:function(t){return!V(t.target).closest(".ui-menu").length},_isDivider:function(t){return!/[^\-\u2014\u2013\s]/.test(t.text())},collapse:function(t){var e=this.active&&this.active.parent().closest(".ui-menu-item",this.element);e&&e.length&&(this._close(),this.focus(t,e))},expand:function(t){var e=this.active&&this._menuItems(this.active.children(".ui-menu")).first();e&&e.length&&(this._open(e.parent()),this._delay(function(){this.focus(t,e)}))},next:function(t){this._move("next","first",t)},previous:function(t){this._move("prev","last",t)},isFirstItem:function(){return this.active&&!this.active.prevAll(".ui-menu-item").length},isLastItem:function(){return this.active&&!this.active.nextAll(".ui-menu-item").length},_menuItems:function(t){return(t||this.element).find(this.options.items).filter(".ui-menu-item")},_move:function(t,e,i){var s;(s=this.active?"first"===t||"last"===t?this.active["first"===t?"prevAll":"nextAll"](".ui-menu-item").last():this.active[t+"All"](".ui-menu-item").first():s)&&s.length&&this.active||(s=this._menuItems(this.activeMenu)[e]()),this.focus(i,s)},nextPage:function(t){var e,i,s;this.active?this.isLastItem()||(this._hasScroll()?(i=this.active.offset().top,s=this.element.innerHeight(),0===V.fn.jquery.indexOf("3.2.")&&(s+=this.element[0].offsetHeight-this.element.outerHeight()),this.active.nextAll(".ui-menu-item").each(function(){return(e=V(this)).offset().top-i-s<0}),this.focus(t,e)):this.focus(t,this._menuItems(this.activeMenu)[this.active?"last":"first"]())):this.next(t)},previousPage:function(t){var e,i,s;this.active?this.isFirstItem()||(this._hasScroll()?(i=this.active.offset().top,s=this.element.innerHeight(),0===V.fn.jquery.indexOf("3.2.")&&(s+=this.element[0].offsetHeight-this.element.outerHeight()),this.active.prevAll(".ui-menu-item").each(function(){return 0<(e=V(this)).offset().top-i+s}),this.focus(t,e)):this.focus(t,this._menuItems(this.activeMenu).first())):this.next(t)},_hasScroll:function(){return this.element.outerHeight()<this.element.prop("scrollHeight")},select:function(t){this.active=this.active||V(t.target).closest(".ui-menu-item");var e={item:this.active};this.active.has(".ui-menu").length||this.collapseAll(t,!0),this._trigger("select",t,e)},_filterMenuItems:function(t){var t=t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&"),e=new RegExp("^"+t,"i");return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function(){return e.test(String.prototype.trim.call(V(this).children(".ui-menu-item-wrapper").text()))})}}),V.widget("ui.autocomplete",{version:"1.14.1",defaultElement:"<input>",options:{appendTo:null,autoFocus:!1,delay:300,minLength:1,position:{my:"left top",at:"left bottom",collision:"none"},source:null,change:null,close:null,focus:null,open:null,response:null,search:null,select:null},requestIndex:0,pending:0,liveRegionTimer:null,_create:function(){var i,s,n,t=this.element[0].nodeName.toLowerCase(),e="textarea"===t,t="input"===t;this.isMultiLine=e||!t&&"true"===this.element.prop("contentEditable"),this.valueMethod=this.element[e||t?"val":"text"],this.isNewMenu=!0,this._addClass("ui-autocomplete-input"),this.element.attr("autocomplete","off"),this._on(this.element,{keydown:function(t){if(this.element.prop("readOnly"))s=n=i=!0;else{s=n=i=!1;var e=V.ui.keyCode;switch(t.keyCode){case e.PAGE_UP:i=!0,this._move("previousPage",t);break;case e.PAGE_DOWN:i=!0,this._move("nextPage",t);break;case e.UP:i=!0,this._keyEvent("previous",t);break;case e.DOWN:i=!0,this._keyEvent("next",t);break;case e.ENTER:this.menu.active&&(i=!0,t.preventDefault(),this.menu.select(t));break;case e.TAB:this.menu.active&&this.menu.select(t);break;case e.ESCAPE:this.menu.element.is(":visible")&&(this.isMultiLine||this._value(this.term),this.close(t),t.preventDefault());break;default:s=!0,this._searchTimeout(t)}}},keypress:function(t){if(i)i=!1,this.isMultiLine&&!this.menu.element.is(":visible")||t.preventDefault();else if(!s){var e=V.ui.keyCode;switch(t.keyCode){case e.PAGE_UP:this._move("previousPage",t);break;case e.PAGE_DOWN:this._move("nextPage",t);break;case e.UP:this._keyEvent("previous",t);break;case e.DOWN:this._keyEvent("next",t)}}},input:function(t){n?(n=!1,t.preventDefault()):this._searchTimeout(t)},focus:function(){this.selectedItem=null,this.previous=this._value()},blur:function(t){clearTimeout(this.searching),this.close(t),this._change(t)}}),this._initSource(),this.menu=V("<ul>").appendTo(this._appendTo()).menu({role:null}).hide().menu("instance"),this._addClass(this.menu.element,"ui-autocomplete","ui-front"),this._on(this.menu.element,{mousedown:function(t){t.preventDefault()},menufocus:function(t,e){var i,s;this.isNewMenu&&(this.isNewMenu=!1,t.originalEvent)&&/^mouse/.test(t.originalEvent.type)?(this.menu.blur(),this.document.one("mousemove",function(){V(t.target).trigger(t.originalEvent)})):(s=e.item.data("ui-autocomplete-item"),!1!==this._trigger("focus",t,{item:s})&&t.originalEvent&&/^key/.test(t.originalEvent.type)&&this._value(s.value),(i=e.item.attr("aria-label")||s.value)&&String.prototype.trim.call(i).length&&(clearTimeout(this.liveRegionTimer),this.liveRegionTimer=this._delay(function(){this.liveRegion.html(V("<div>").text(i))},100)))},menuselect:function(t,e){var e=e.item.data("ui-autocomplete-item"),i=this.previous;this.element[0]!==this.document[0].activeElement&&(this.element.trigger("focus"),this.previous=i),!1!==this._trigger("select",t,{item:e})&&this._value(e.value),this.term=this._value(),this.close(t),this.selectedItem=e}}),this.liveRegion=V("<div>",{role:"status","aria-live":"assertive","aria-relevant":"additions"}).appendTo(this.document[0].body),this._addClass(this.liveRegion,null,"ui-helper-hidden-accessible"),this._on(this.window,{beforeunload:function(){this.element.removeAttr("autocomplete")}})},_destroy:function(){clearTimeout(this.searching),this.element.removeAttr("autocomplete"),this.menu.element.remove(),this.liveRegion.remove()},_setOption:function(t,e){this._super(t,e),"source"===t&&this._initSource(),"appendTo"===t&&this.menu.element.appendTo(this._appendTo()),"disabled"===t&&e&&this.xhr&&this.xhr.abort()},_isEventTargetInWidget:function(t){var e=this.menu.element[0];return t.target===this.element[0]||t.target===e||V.contains(e,t.target)},_closeOnClickOutside:function(t){this._isEventTargetInWidget(t)||this.close()},_appendTo:function(){var t=this.options.appendTo;return t=(t=(t=t&&(t.jquery||t.nodeType?V(t):this.document.find(t).eq(0)))&&t[0]?t:this.element.closest(".ui-front, dialog")).length?t:this.document[0].body},_initSource:function(){var i,s,n=this;Array.isArray(this.options.source)?(i=this.options.source,this.source=function(t,e){e(V.ui.autocomplete.filter(i,t.term))}):"string"==typeof this.options.source?(s=this.options.source,this.source=function(t,e){n.xhr&&n.xhr.abort(),n.xhr=V.ajax({url:s,data:t,dataType:"json",success:function(t){e(t)},error:function(){e([])}})}):this.source=this.options.source},_searchTimeout:function(s){clearTimeout(this.searching),this.searching=this._delay(function(){var t=this.term===this._value(),e=this.menu.element.is(":visible"),i=s.altKey||s.ctrlKey||s.metaKey||s.shiftKey;t&&(e||i)||(this.selectedItem=null,this.search(null,s))},this.options.delay)},search:function(t,e){return t=null!=t?t:this._value(),this.term=this._value(),t.length<this.options.minLength?this.close(e):!1!==this._trigger("search",e)?this._search(t):void 0},_search:function(t){this.pending++,this._addClass("ui-autocomplete-loading"),this.cancelSearch=!1,this.source({term:t},this._response())},_response:function(){var e=++this.requestIndex;return function(t){e===this.requestIndex&&this.__response(t),this.pending--,this.pending||this._removeClass("ui-autocomplete-loading")}.bind(this)},__response:function(t){t=t&&this._normalize(t),this._trigger("response",null,{content:t}),!this.options.disabled&&t&&t.length&&!this.cancelSearch?(this._suggest(t),this._trigger("open")):this._close()},close:function(t){this.cancelSearch=!0,this._close(t)},_close:function(t){this._off(this.document,"mousedown"),this.menu.element.is(":visible")&&(this.menu.element.hide(),this.menu.blur(),this.isNewMenu=!0,this._trigger("close",t))},_change:function(t){this.previous!==this._value()&&this._trigger("change",t,{item:this.selectedItem})},_normalize:function(t){return t.length&&t[0].label&&t[0].value?t:V.map(t,function(t){return"string"==typeof t?{label:t,value:t}:V.extend({},t,{label:t.label||t.value,value:t.value||t.label})})},_suggest:function(t){var e=this.menu.element.empty();this._renderMenu(e,t),this.isNewMenu=!0,this.menu.refresh(),e.show(),this._resizeMenu(),e.position(V.extend({of:this.element},this.options.position)),this.options.autoFocus&&this.menu.next(),this._on(this.document,{mousedown:"_closeOnClickOutside"})},_resizeMenu:function(){var t=this.menu.element;t.outerWidth(Math.max(t.width("").outerWidth()+1,this.element.outerWidth()))},_renderMenu:function(i,t){var s=this;V.each(t,function(t,e){s._renderItemData(i,e)})},_renderItemData:function(t,e){return this._renderItem(t,e).data("ui-autocomplete-item",e)},_renderItem:function(t,e){return V("<li>").append(V("<div>").text(e.label)).appendTo(t)},_move:function(t,e){this.menu.element.is(":visible")?this.menu.isFirstItem()&&/^previous/.test(t)||this.menu.isLastItem()&&/^next/.test(t)?(this.isMultiLine||this._value(this.term),this.menu.blur()):this.menu[t](e):this.search(null,e)},widget:function(){return this.menu.element},_value:function(){return this.valueMethod.apply(this.element,arguments)},_keyEvent:function(t,e){this.isMultiLine&&!this.menu.element.is(":visible")||(this._move(t,e),e.preventDefault())}}),V.extend(V.ui.autocomplete,{escapeRegex:function(t){return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&")},filter:function(t,e){var i=new RegExp(V.ui.autocomplete.escapeRegex(e),"i");return V.grep(t,function(t){return i.test(t.label||t.value||t)})}}),V.widget("ui.autocomplete",V.ui.autocomplete,{options:{messages:{noResults:"No search results.",results:function(t){return t+(1<t?" results are":" result is")+" available, use up and down arrow keys to navigate."}}},__response:function(t){var e;this._superApply(arguments),this.options.disabled||this.cancelSearch||(e=t&&t.length?this.options.messages.results(t.length):this.options.messages.noResults,clearTimeout(this.liveRegionTimer),this.liveRegionTimer=this._delay(function(){this.liveRegion.html(V("<div>").text(e))},100))}}),V.ui.autocomplete,/ui-corner-([a-z]){2,6}/g);V.widget("ui.controlgroup",{version:"1.14.1",defaultElement:"<div>",options:{direction:"horizontal",disabled:null,onlyVisible:!0,items:{button:"input[type=button], input[type=submit], input[type=reset], button, a",controlgroupLabel:".ui-controlgroup-label",checkboxradio:"input[type='checkbox'], input[type='radio']",selectmenu:"select",spinner:".ui-spinner-input"}},_create:function(){this._enhance()},_enhance:function(){this.element.attr("role","toolbar"),this.refresh()},_destroy:function(){this._callChildMethod("destroy"),this.childWidgets.removeData("ui-controlgroup-data"),this.element.removeAttr("role"),this.options.items.controlgroupLabel&&this.element.find(this.options.items.controlgroupLabel).find(".ui-controlgroup-label-contents").contents().unwrap()},_initWidgets:function(){var o=this,a=[];V.each(this.options.items,function(s,t){var e,n={};t&&("controlgroupLabel"===s?((e=o.element.find(t)).each(function(){var t=V(this);t.children(".ui-controlgroup-label-contents").length||t.contents().wrapAll("<span class='ui-controlgroup-label-contents'></span>")}),o._addClass(e,null,"ui-widget ui-widget-content ui-state-default"),a=a.concat(e.get())):V.fn[s]&&(n=o["_"+s+"Options"]?o["_"+s+"Options"]("middle"):{classes:{}},o.element.find(t).each(function(){var t=V(this),e=t[s]("instance"),i=V.widget.extend({},n);"button"===s&&t.parent(".ui-spinner").length||((e=e||t[s]()[s]("instance"))&&(i.classes=o._resolveClassesValues(i.classes,e)),t[s](i),i=t[s]("widget"),V.data(i[0],"ui-controlgroup-data",e||t[s]("instance")),a.push(i[0]))})))}),this.childWidgets=V(V.uniqueSort(a)),this._addClass(this.childWidgets,"ui-controlgroup-item")},_callChildMethod:function(e){this.childWidgets.each(function(){var t=V(this).data("ui-controlgroup-data");t&&t[e]&&t[e]()})},_updateCornerClass:function(t,e){e=this._buildSimpleOptions(e,"label").classes.label;this._removeClass(t,null,"ui-corner-top ui-corner-bottom ui-corner-left ui-corner-right ui-corner-all"),this._addClass(t,null,e)},_buildSimpleOptions:function(t,e){var i="vertical"===this.options.direction,s={classes:{}};return s.classes[e]={middle:"",first:"ui-corner-"+(i?"top":"left"),last:"ui-corner-"+(i?"bottom":"right"),only:"ui-corner-all"}[t],s},_spinnerOptions:function(t){t=this._buildSimpleOptions(t,"ui-spinner");return t.classes["ui-spinner-up"]="",t.classes["ui-spinner-down"]="",t},_buttonOptions:function(t){return this._buildSimpleOptions(t,"ui-button")},_checkboxradioOptions:function(t){return this._buildSimpleOptions(t,"ui-checkboxradio-label")},_selectmenuOptions:function(t){var e="vertical"===this.options.direction;return{width:e&&"auto",classes:{middle:{"ui-selectmenu-button-open":"","ui-selectmenu-button-closed":""},first:{"ui-selectmenu-button-open":"ui-corner-"+(e?"top":"tl"),"ui-selectmenu-button-closed":"ui-corner-"+(e?"top":"left")},last:{"ui-selectmenu-button-open":e?"":"ui-corner-tr","ui-selectmenu-button-closed":"ui-corner-"+(e?"bottom":"right")},only:{"ui-selectmenu-button-open":"ui-corner-top","ui-selectmenu-button-closed":"ui-corner-all"}}[t]}},_resolveClassesValues:function(i,s){var n={};return V.each(i,function(t){var e=s.options.classes[t]||"",e=String.prototype.trim.call(e.replace(st,""));n[t]=(e+" "+i[t]).replace(/\s+/g," ")}),n},_setOption:function(t,e){"direction"===t&&this._removeClass("ui-controlgroup-"+this.options.direction),this._super(t,e),"disabled"===t?this._callChildMethod(e?"disable":"enable"):this.refresh()},refresh:function(){var n,o=this;this._addClass("ui-controlgroup ui-controlgroup-"+this.options.direction),"horizontal"===this.options.direction&&this._addClass(null,"ui-helper-clearfix"),this._initWidgets(),n=this.childWidgets,(n=this.options.onlyVisible?n.filter(":visible"):n).length&&(V.each(["first","last"],function(t,e){var i,s=n[e]().data("ui-controlgroup-data");s&&o["_"+s.widgetName+"Options"]?((i=o["_"+s.widgetName+"Options"](1===n.length?"only":e)).classes=o._resolveClassesValues(i.classes,s),s.element[s.widgetName](i)):o._updateCornerClass(n[e](),e)}),this._callChildMethod("refresh"))}}),V.widget("ui.checkboxradio",[V.ui.formResetMixin,{version:"1.14.1",options:{disabled:null,label:null,icon:!0,classes:{"ui-checkboxradio-label":"ui-corner-all","ui-checkboxradio-icon":"ui-corner-all"}},_getCreateOptions:function(){var t,e=this._super()||{};return this._readType(),t=this.element.labels(),this.label=V(t[t.length-1]),this.label.length||V.error("No label found for checkboxradio widget"),this.originalLabel="",(t=this.label.contents().not(this.element[0])).length&&(this.originalLabel+=t.clone().wrapAll("<div></div>").parent().html()),this.originalLabel&&(e.label=this.originalLabel),null!=(t=this.element[0].disabled)&&(e.disabled=t),e},_create:function(){var t=this.element[0].checked;this._bindFormResetHandler(),null==this.options.disabled&&(this.options.disabled=this.element[0].disabled),this._setOption("disabled",this.options.disabled),this._addClass("ui-checkboxradio","ui-helper-hidden-accessible"),this._addClass(this.label,"ui-checkboxradio-label","ui-button ui-widget"),"radio"===this.type&&this._addClass(this.label,"ui-checkboxradio-radio-label"),this.options.label&&this.options.label!==this.originalLabel?this._updateLabel():this.originalLabel&&(this.options.label=this.originalLabel),this._enhance(),t&&this._addClass(this.label,"ui-checkboxradio-checked","ui-state-active"),this._on({change:"_toggleClasses",focus:function(){this._addClass(this.label,null,"ui-state-focus ui-visual-focus")},blur:function(){this._removeClass(this.label,null,"ui-state-focus ui-visual-focus")}})},_readType:function(){var t=this.element[0].nodeName.toLowerCase();this.type=this.element[0].type,"input"===t&&/radio|checkbox/.test(this.type)||V.error("Can't create checkboxradio on element.nodeName="+t+" and element.type="+this.type)},_enhance:function(){this._updateIcon(this.element[0].checked)},widget:function(){return this.label},_getRadioGroup:function(){var t=this.element[0].name,e="input[name='"+CSS.escape(t)+"']";return t?(this.form.length?V(this.form[0].elements).filter(e):V(e).filter(function(){return 0===V(V(this).prop("form")).length})).not(this.element):V([])},_toggleClasses:function(){var t=this.element[0].checked;this._toggleClass(this.label,"ui-checkboxradio-checked","ui-state-active",t),this.options.icon&&"checkbox"===this.type&&this._toggleClass(this.icon,null,"ui-icon-check ui-state-checked",t)._toggleClass(this.icon,null,"ui-icon-blank",!t),"radio"===this.type&&this._getRadioGroup().each(function(){var t=V(this).checkboxradio("instance");t&&t._removeClass(t.label,"ui-checkboxradio-checked","ui-state-active")})},_destroy:function(){this._unbindFormResetHandler(),this.icon&&(this.icon.remove(),this.iconSpace.remove())},_setOption:function(t,e){"label"===t&&!e||(this._super(t,e),"disabled"===t?(this._toggleClass(this.label,null,"ui-state-disabled",e),this.element[0].disabled=e):this.refresh())},_updateIcon:function(t){var e="ui-icon ui-icon-background ";this.options.icon?(this.icon||(this.icon=V("<span>"),this.iconSpace=V("<span> </span>"),this._addClass(this.iconSpace,"ui-checkboxradio-icon-space")),"checkbox"===this.type?(e+=t?"ui-icon-check ui-state-checked":"ui-icon-blank",this._removeClass(this.icon,null,t?"ui-icon-blank":"ui-icon-check")):e+="ui-icon-blank",this._addClass(this.icon,"ui-checkboxradio-icon",e),t||this._removeClass(this.icon,null,"ui-icon-check ui-state-checked"),this.icon.prependTo(this.label).after(this.iconSpace)):void 0!==this.icon&&(this.icon.remove(),this.iconSpace.remove(),delete this.icon)},_updateLabel:function(){var t=this.label.contents().not(this.element[0]);this.icon&&(t=t.not(this.icon[0])),(t=this.iconSpace?t.not(this.iconSpace[0]):t).remove(),this.label.append(this.options.label)},refresh:function(){var t=this.element[0].checked,e=this.element[0].disabled;this._updateIcon(t),this._toggleClass(this.label,"ui-checkboxradio-checked","ui-state-active",t),null!==this.options.label&&this._updateLabel(),e!==this.options.disabled&&this._setOptions({disabled:e})}}]),V.ui.checkboxradio,V.widget("ui.button",{version:"1.14.1",defaultElement:"<button>",options:{classes:{"ui-button":"ui-corner-all"},disabled:null,icon:null,iconPosition:"beginning",label:null,showLabel:!0},_getCreateOptions:function(){var t,e=this._super()||{};return this.isInput=this.element.is("input"),null!=(t=this.element[0].disabled)&&(e.disabled=t),this.originalLabel=this.isInput?this.element.val():this.element.html(),this.originalLabel&&(e.label=this.originalLabel),e},_create:function(){!this.option.showLabel&!this.options.icon&&(this.options.showLabel=!0),null==this.options.disabled&&(this.options.disabled=this.element[0].disabled||!1),this.hasTitle=!!this.element.attr("title"),this.options.label&&this.options.label!==this.originalLabel&&(this.isInput?this.element.val(this.options.label):this.element.html(this.options.label)),this._addClass("ui-button","ui-widget"),this._setOption("disabled",this.options.disabled),this._enhance(),this.element.is("a")&&this._on({keyup:function(t){t.keyCode===V.ui.keyCode.SPACE&&(t.preventDefault(),this.element[0].click?this.element[0].click():this.element.trigger("click"))}})},_enhance:function(){this.element.is("button")||this.element.attr("role","button"),this.options.icon&&(this._updateIcon("icon",this.options.icon),this._updateTooltip())},_updateTooltip:function(){this.title=this.element.attr("title"),this.options.showLabel||this.title||this.element.attr("title",this.options.label)},_updateIcon:function(t,e){var t="iconPosition"!==t,i=t?this.options.iconPosition:e,s="top"===i||"bottom"===i;this.icon?t&&this._removeClass(this.icon,null,this.options.icon):(this.icon=V("<span>"),this._addClass(this.icon,"ui-button-icon","ui-icon"),this.options.showLabel||this._addClass("ui-button-icon-only")),t&&this._addClass(this.icon,null,e),this._attachIcon(i),s?(this._addClass(this.icon,null,"ui-widget-icon-block"),this.iconSpace&&this.iconSpace.remove()):(this.iconSpace||(this.iconSpace=V("<span> </span>"),this._addClass(this.iconSpace,"ui-button-icon-space")),this._removeClass(this.icon,null,"ui-wiget-icon-block"),this._attachIconSpace(i))},_destroy:function(){this.element.removeAttr("role"),this.icon&&this.icon.remove(),this.iconSpace&&this.iconSpace.remove(),this.hasTitle||this.element.removeAttr("title")},_attachIconSpace:function(t){this.icon[/^(?:end|bottom)/.test(t)?"before":"after"](this.iconSpace)},_attachIcon:function(t){this.element[/^(?:end|bottom)/.test(t)?"append":"prepend"](this.icon)},_setOptions:function(t){var e=(void 0===t.showLabel?this.options:t).showLabel,i=(void 0===t.icon?this.options:t).icon;e||i||(t.showLabel=!0),this._super(t)},_setOption:function(t,e){"icon"===t&&(e?this._updateIcon(t,e):this.icon&&(this.icon.remove(),this.iconSpace)&&this.iconSpace.remove()),"iconPosition"===t&&this._updateIcon(t,e),"showLabel"===t&&(this._toggleClass("ui-button-icon-only",null,!e),this._updateTooltip()),"label"===t&&(this.isInput?this.element.val(e):(this.element.html(e),this.icon&&(this._attachIcon(this.options.iconPosition),this._attachIconSpace(this.options.iconPosition)))),this._super(t,e),"disabled"===t&&(this._toggleClass(null,"ui-state-disabled",e),this.element[0].disabled=e)&&this.element.trigger("blur")},refresh:function(){var t=this.element.is("input, button")?this.element[0].disabled:this.element.hasClass("ui-button-disabled");t!==this.options.disabled&&this._setOptions({disabled:t}),this._updateTooltip()}}),!0===V.uiBackCompat&&(V.widget("ui.button",V.ui.button,{options:{text:!0,icons:{primary:null,secondary:null}},_create:function(){this.options.showLabel&&!this.options.text&&(this.options.showLabel=this.options.text),!this.options.showLabel&&this.options.text&&(this.options.text=this.options.showLabel),this.options.icon||!this.options.icons.primary&&!this.options.icons.secondary?this.options.icon&&(this.options.icons.primary=this.options.icon):this.options.icons.primary?this.options.icon=this.options.icons.primary:(this.options.icon=this.options.icons.secondary,this.options.iconPosition="end"),this._super()},_setOption:function(t,e){"text"===t?this._super("showLabel",e):("showLabel"===t&&(this.options.text=e),"icon"===t&&(this.options.icons.primary=e),"icons"===t&&(e.primary?(this._super("icon",e.primary),this._super("iconPosition","beginning")):e.secondary&&(this._super("icon",e.secondary),this._super("iconPosition","end"))),this._superApply(arguments))}}),V.fn.button=(et=V.fn.button,function(i){var t="string"==typeof i,s=Array.prototype.slice.call(arguments,1),n=this;return t?this.length||"instance"!==i?this.each(function(){var t,e=V(this).attr("type"),e=V.data(this,"ui-"+("checkbox"!==e&&"radio"!==e?"button":"checkboxradio"));return"instance"===i?(n=e,!1):e?"function"!=typeof e[i]||"_"===i.charAt(0)?V.error("no such method '"+i+"' for button widget instance"):(t=e[i].apply(e,s))!==e&&void 0!==t?(n=t&&t.jquery?n.pushStack(t.get()):t,!1):void 0:V.error("cannot call methods on button prior to initialization; attempted to call method '"+i+"'")}):n=void 0:(s.length&&(i=V.widget.extend.apply(null,[i].concat(s))),this.each(function(){var t=V(this).attr("type"),t="checkbox"!==t&&"radio"!==t?"button":"checkboxradio",e=V.data(this,"ui-"+t);e?(e.option(i||{}),e._init&&e._init()):"button"==t?et.call(V(this),i):V(this).checkboxradio(V.extend({icon:!1},i))})),n}),V.fn.buttonset=function(){return V.ui.controlgroup||V.error("Controlgroup widget missing"),"option"===arguments[0]&&"items"===arguments[1]&&arguments[2]?this.controlgroup.apply(this,[arguments[0],"items.button",arguments[2]]):"option"===arguments[0]&&"items"===arguments[1]?this.controlgroup.apply(this,[arguments[0],"items.button"]):("object"==typeof arguments[0]&&arguments[0].items&&(arguments[0].items={button:arguments[0].items}),this.controlgroup.apply(this,arguments))}),V.ui.button;function nt(){this._curInst=null,this._keyEvent=!1,this._disabledInputs=[],this._datepickerShowing=!1,this._inDialog=!1,this._mainDivId="ui-datepicker-div",this._inlineClass="ui-datepicker-inline",this._appendClass="ui-datepicker-append",this._triggerClass="ui-datepicker-trigger",this._dialogClass="ui-datepicker-dialog",this._disableClass="ui-datepicker-disabled",this._unselectableClass="ui-datepicker-unselectable",this._currentClass="ui-datepicker-current-day",this._dayOverClass="ui-datepicker-days-cell-over",this.regional=[],this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],weekHeader:"Wk",dateFormat:"mm/dd/yy",firstDay:0,isRTL:!1,showMonthAfterYear:!1,yearSuffix:"",selectMonthLabel:"Select month",selectYearLabel:"Select year"},this._defaults={showOn:"focus",showAnim:"fadeIn",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:!1,hideIfNoPrevNext:!1,navigationAsDateFormat:!1,gotoCurrent:!1,changeMonth:!1,changeYear:!1,yearRange:"c-10:c+10",showOtherMonths:!1,selectOtherMonths:!1,showWeek:!1,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",minDate:null,maxDate:null,duration:"fast",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,onUpdateDatepicker:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:!0,showButtonPanel:!1,autoSize:!1,disabled:!1},V.extend(this._defaults,this.regional[""]),this.regional.en=V.extend(!0,{},this.regional[""]),this.regional["en-US"]=V.extend(!0,{},this.regional.en),this.dpDiv=ot(V("<div id='"+this._mainDivId+"' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))}function ot(t){var e="button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";return t.on("mouseout",e,function(){V(this).removeClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&V(this).removeClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&V(this).removeClass("ui-datepicker-next-hover")}).on("mouseover",e,at)}function at(){V.datepicker._isDisabledDatepicker((S.inline?S.dpDiv.parent():S.input)[0])||(V(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),V(this).addClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&V(this).addClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&V(this).addClass("ui-datepicker-next-hover"))}function H(t,e){for(var i in V.extend(t,e),e)null==e[i]&&(t[i]=e[i])}V.extend(V.ui,{datepicker:{version:"1.14.1"}}),V.extend(nt.prototype,{markerClassName:"hasDatepicker",maxRows:4,_widgetDatepicker:function(){return this.dpDiv},setDefaults:function(t){return H(this._defaults,t||{}),this},_attachDatepicker:function(t,e){var i,s=t.nodeName.toLowerCase(),n="div"===s||"span"===s;t.id||(this.uuid+=1,t.id="dp"+this.uuid),(i=this._newInst(V(t),n)).settings=V.extend({},e||{}),"input"===s?this._connectDatepicker(t,i):n&&this._inlineDatepicker(t,i)},_newInst:function(t,e){return{id:t[0].id.replace(/([^A-Za-z0-9_\-])/g,"\\\\$1"),input:t,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:e,dpDiv:e?ot(V("<div class='"+this._inlineClass+" ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")):this.dpDiv}},_connectDatepicker:function(t,e){var i=V(t);e.append=V([]),e.trigger=V([]),i.hasClass(this.markerClassName)||(this._attachments(i,e),i.addClass(this.markerClassName).on("keydown",this._doKeyDown).on("keypress",this._doKeyPress).on("keyup",this._doKeyUp),this._autoSize(e),V.data(t,"datepicker",e),e.settings.disabled&&this._disableDatepicker(t))},_attachments:function(t,e){var i,s=this._get(e,"appendText"),n=this._get(e,"isRTL");e.append&&e.append.remove(),s&&(e.append=V("<span>").addClass(this._appendClass).text(s),t[n?"before":"after"](e.append)),t.off("focus",this._showDatepicker),e.trigger&&e.trigger.remove(),"focus"!==(s=this._get(e,"showOn"))&&"both"!==s||t.on("focus",this._showDatepicker),"button"!==s&&"both"!==s||(s=this._get(e,"buttonText"),i=this._get(e,"buttonImage"),this._get(e,"buttonImageOnly")?e.trigger=V("<img>").addClass(this._triggerClass).attr({src:i,alt:s,title:s}):(e.trigger=V("<button type='button'>").addClass(this._triggerClass),i?e.trigger.html(V("<img>").attr({src:i,alt:s,title:s})):e.trigger.text(s)),t[n?"before":"after"](e.trigger),e.trigger.on("click",function(){return V.datepicker._datepickerShowing&&V.datepicker._lastInput===t[0]?V.datepicker._hideDatepicker():(V.datepicker._datepickerShowing&&V.datepicker._lastInput!==t[0]&&V.datepicker._hideDatepicker(),V.datepicker._showDatepicker(t[0])),!1}))},_autoSize:function(t){var e,i,s,n,o,a;this._get(t,"autoSize")&&!t.inline&&(o=new Date(2009,11,20),(a=this._get(t,"dateFormat")).match(/[DM]/)&&(o.setMonth((e=function(t){for(n=s=i=0;n<t.length;n++)t[n].length>i&&(i=t[n].length,s=n);return s})(this._get(t,a.match(/MM/)?"monthNames":"monthNamesShort"))),o.setDate(e(this._get(t,a.match(/DD/)?"dayNames":"dayNamesShort"))+20-o.getDay())),t.input.attr("size",this._formatDate(t,o).length))},_inlineDatepicker:function(t,e){var i=V(t);i.hasClass(this.markerClassName)||(i.addClass(this.markerClassName).append(e.dpDiv),V.data(t,"datepicker",e),this._setDate(e,this._getDefaultDate(e),!0),this._updateDatepicker(e),this._updateAlternate(e),e.settings.disabled&&this._disableDatepicker(t),e.dpDiv.css("display","block"))},_dialogDatepicker:function(t,e,i,s,n){var o,a=this._dialogInst;return a||(this.uuid+=1,o="dp"+this.uuid,this._dialogInput=V("<input type='text' id='"+o+"' style='position: absolute; top: -100px; width: 0px;'/>"),this._dialogInput.on("keydown",this._doKeyDown),V("body").append(this._dialogInput),(a=this._dialogInst=this._newInst(this._dialogInput,!1)).settings={},V.data(this._dialogInput[0],"datepicker",a)),H(a.settings,s||{}),e=e&&e.constructor===Date?this._formatDate(a,e):e,this._dialogInput.val(e),this._pos=n?n.length?n:[n.pageX,n.pageY]:null,this._pos||(o=document.documentElement.clientWidth,s=document.documentElement.clientHeight,e=document.documentElement.scrollLeft||document.body.scrollLeft,n=document.documentElement.scrollTop||document.body.scrollTop,this._pos=[o/2-100+e,s/2-150+n]),this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px"),a.settings.onSelect=i,this._inDialog=!0,this.dpDiv.addClass(this._dialogClass),this._showDatepicker(this._dialogInput[0]),V.blockUI&&V.blockUI(this.dpDiv),V.data(this._dialogInput[0],"datepicker",a),this},_destroyDatepicker:function(t){var e,i=V(t),s=V.data(t,"datepicker");i.hasClass(this.markerClassName)&&(e=t.nodeName.toLowerCase(),V.removeData(t,"datepicker"),"input"===e?(s.append.remove(),s.trigger.remove(),i.removeClass(this.markerClassName).off("focus",this._showDatepicker).off("keydown",this._doKeyDown).off("keypress",this._doKeyPress).off("keyup",this._doKeyUp)):"div"!==e&&"span"!==e||i.removeClass(this.markerClassName).empty(),V.datepicker._hideDatepicker(),S===s)&&(S=null,this._curInst=null)},_enableDatepicker:function(e){var t,i=V(e),s=V.data(e,"datepicker");i.hasClass(this.markerClassName)&&("input"===(t=e.nodeName.toLowerCase())?(e.disabled=!1,s.trigger.filter("button").each(function(){this.disabled=!1}).end().filter("img").css({opacity:"1.0",cursor:""})):"div"!==t&&"span"!==t||((s=i.children("."+this._inlineClass)).children().removeClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!1)),this._disabledInputs=V.map(this._disabledInputs,function(t){return t===e?null:t}))},_disableDatepicker:function(e){var t,i=V(e),s=V.data(e,"datepicker");i.hasClass(this.markerClassName)&&("input"===(t=e.nodeName.toLowerCase())?(e.disabled=!0,s.trigger.filter("button").each(function(){this.disabled=!0}).end().filter("img").css({opacity:"0.5",cursor:"default"})):"div"!==t&&"span"!==t||((s=i.children("."+this._inlineClass)).children().addClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!0)),this._disabledInputs=V.map(this._disabledInputs,function(t){return t===e?null:t}),this._disabledInputs[this._disabledInputs.length]=e)},_isDisabledDatepicker:function(t){if(t)for(var e=0;e<this._disabledInputs.length;e++)if(this._disabledInputs[e]===t)return!0;return!1},_getInst:function(t){try{return V.data(t,"datepicker")}catch(t){throw"Missing instance data for this datepicker"}},_optionDatepicker:function(t,e,i){var s,n,o=this._getInst(t);if(2===arguments.length&&"string"==typeof e)return"defaults"===e?V.extend({},V.datepicker._defaults):o?"all"===e?V.extend({},o.settings):this._get(o,e):null;s=e||{},"string"==typeof e&&((s={})[e]=i),o&&(this._curInst===o&&this._hideDatepicker(),e=this._getDateDatepicker(t,!0),i=this._getMinMaxDate(o,"min"),n=this._getMinMaxDate(o,"max"),H(o.settings,s),null!==i&&void 0!==s.dateFormat&&void 0===s.minDate&&(o.settings.minDate=this._formatDate(o,i)),null!==n&&void 0!==s.dateFormat&&void 0===s.maxDate&&(o.settings.maxDate=this._formatDate(o,n)),"disabled"in s&&(s.disabled?this._disableDatepicker(t):this._enableDatepicker(t)),this._attachments(V(t),o),this._autoSize(o),this._setDate(o,e),this._updateAlternate(o),this._updateDatepicker(o))},_changeDatepicker:function(t,e,i){this._optionDatepicker(t,e,i)},_refreshDatepicker:function(t){t=this._getInst(t);t&&this._updateDatepicker(t)},_setDateDatepicker:function(t,e){t=this._getInst(t);t&&(this._setDate(t,e),this._updateDatepicker(t),this._updateAlternate(t))},_getDateDatepicker:function(t,e){t=this._getInst(t);return t&&!t.inline&&this._setDateFromField(t,e),t?this._getDate(t):null},_doKeyDown:function(t){var e,i,s=V.datepicker._getInst(t.target),n=!0,o=s.dpDiv.is(".ui-datepicker-rtl");if(s._keyEvent=!0,V.datepicker._datepickerShowing)switch(t.keyCode){case 9:V.datepicker._hideDatepicker(),n=!1;break;case 13:return(i=V("td."+V.datepicker._dayOverClass+":not(."+V.datepicker._currentClass+")",s.dpDiv))[0]&&V.datepicker._selectDay(t.target,s.selectedMonth,s.selectedYear,i[0]),(i=V.datepicker._get(s,"onSelect"))?(e=V.datepicker._formatDate(s),i.apply(s.input?s.input[0]:null,[e,s])):V.datepicker._hideDatepicker(),!1;case 27:V.datepicker._hideDatepicker();break;case 33:V.datepicker._adjustDate(t.target,t.ctrlKey?-V.datepicker._get(s,"stepBigMonths"):-V.datepicker._get(s,"stepMonths"),"M");break;case 34:V.datepicker._adjustDate(t.target,t.ctrlKey?+V.datepicker._get(s,"stepBigMonths"):+V.datepicker._get(s,"stepMonths"),"M");break;case 35:(t.ctrlKey||t.metaKey)&&V.datepicker._clearDate(t.target),n=t.ctrlKey||t.metaKey;break;case 36:(t.ctrlKey||t.metaKey)&&V.datepicker._gotoToday(t.target),n=t.ctrlKey||t.metaKey;break;case 37:(t.ctrlKey||t.metaKey)&&V.datepicker._adjustDate(t.target,o?1:-1,"D"),n=t.ctrlKey||t.metaKey,t.originalEvent.altKey&&V.datepicker._adjustDate(t.target,t.ctrlKey?-V.datepicker._get(s,"stepBigMonths"):-V.datepicker._get(s,"stepMonths"),"M");break;case 38:(t.ctrlKey||t.metaKey)&&V.datepicker._adjustDate(t.target,-7,"D"),n=t.ctrlKey||t.metaKey;break;case 39:(t.ctrlKey||t.metaKey)&&V.datepicker._adjustDate(t.target,o?-1:1,"D"),n=t.ctrlKey||t.metaKey,t.originalEvent.altKey&&V.datepicker._adjustDate(t.target,t.ctrlKey?+V.datepicker._get(s,"stepBigMonths"):+V.datepicker._get(s,"stepMonths"),"M");break;case 40:(t.ctrlKey||t.metaKey)&&V.datepicker._adjustDate(t.target,7,"D"),n=t.ctrlKey||t.metaKey;break;default:n=!1}else 36===t.keyCode&&t.ctrlKey?V.datepicker._showDatepicker(this):n=!1;n&&(t.preventDefault(),t.stopPropagation())},_doKeyPress:function(t){var e,i=V.datepicker._getInst(t.target);if(V.datepicker._get(i,"constrainInput"))return i=V.datepicker._possibleChars(V.datepicker._get(i,"dateFormat")),e=String.fromCharCode(null==t.charCode?t.keyCode:t.charCode),t.ctrlKey||t.metaKey||e<" "||!i||-1<i.indexOf(e)},_doKeyUp:function(t){t=V.datepicker._getInst(t.target);if(t.input.val()!==t.lastVal)try{V.datepicker.parseDate(V.datepicker._get(t,"dateFormat"),t.input?t.input.val():null,V.datepicker._getFormatConfig(t))&&(V.datepicker._setDateFromField(t),V.datepicker._updateAlternate(t),V.datepicker._updateDatepicker(t))}catch(t){}return!0},_showDatepicker:function(t){var e,i,s,n;"input"!==(t=t.target||t).nodeName.toLowerCase()&&(t=V("input",t.parentNode)[0]),V.datepicker._isDisabledDatepicker(t)||V.datepicker._lastInput===t||(n=V.datepicker._getInst(t),V.datepicker._curInst&&V.datepicker._curInst!==n&&(V.datepicker._curInst.dpDiv.stop(!0,!0),n)&&V.datepicker._datepickerShowing&&V.datepicker._hideDatepicker(V.datepicker._curInst.input[0]),!1===(i=(i=V.datepicker._get(n,"beforeShow"))?i.apply(t,[t,n]):{}))||(H(n.settings,i),n.lastVal=null,V.datepicker._lastInput=t,V.datepicker._setDateFromField(n),V.datepicker._inDialog&&(t.value=""),V.datepicker._pos||(V.datepicker._pos=V.datepicker._findPos(t),V.datepicker._pos[1]+=t.offsetHeight),e=!1,V(t).parents().each(function(){return!(e|="fixed"===V(this).css("position"))}),i={left:V.datepicker._pos[0],top:V.datepicker._pos[1]},V.datepicker._pos=null,n.dpDiv.empty(),n.dpDiv.css({position:"absolute",display:"block",top:"-1000px"}),V.datepicker._updateDatepicker(n),i=V.datepicker._checkOffset(n,i,e),n.dpDiv.css({position:V.datepicker._inDialog&&V.blockUI?"static":e?"fixed":"absolute",display:"none",left:i.left+"px",top:i.top+"px"}),n.inline)||(i=V.datepicker._get(n,"showAnim"),s=V.datepicker._get(n,"duration"),n.dpDiv.css("z-index",(t=>{for(var e;t.length&&t[0]!==document;){if(("absolute"===(e=t.css("position"))||"relative"===e||"fixed"===e)&&(e=parseInt(t.css("zIndex"),10),!isNaN(e))&&0!==e)return e;t=t.parent()}return 0})(V(t))+1),V.datepicker._datepickerShowing=!0,V.effects&&V.effects.effect[i]?n.dpDiv.show(i,V.datepicker._get(n,"showOptions"),s):n.dpDiv[i||"show"](i?s:null),V.datepicker._shouldFocusInput(n)&&n.input.trigger("focus"),V.datepicker._curInst=n)},_updateDatepicker:function(t){this.maxRows=4,(S=t).dpDiv.empty().append(this._generateHTML(t)),this._attachHandlers(t);var e,i=this._getNumberOfMonths(t),s=i[1],n=t.dpDiv.find("."+this._dayOverClass+" a"),o=V.datepicker._get(t,"onUpdateDatepicker");0<n.length&&at.apply(n.get(0)),t.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""),1<s&&t.dpDiv.addClass("ui-datepicker-multi-"+s).css("width",17*s+"em"),t.dpDiv[(1!==i[0]||1!==i[1]?"add":"remove")+"Class"]("ui-datepicker-multi"),t.dpDiv[(this._get(t,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl"),t===V.datepicker._curInst&&V.datepicker._datepickerShowing&&V.datepicker._shouldFocusInput(t)&&t.input.trigger("focus"),t.yearshtml&&(e=t.yearshtml,setTimeout(function(){e===t.yearshtml&&t.yearshtml&&t.dpDiv.find("select.ui-datepicker-year").first().replaceWith(t.yearshtml),e=t.yearshtml=null},0)),o&&o.apply(t.input?t.input[0]:null,[t])},_shouldFocusInput:function(t){return t.input&&t.input.is(":visible")&&!t.input.is(":disabled")},_checkOffset:function(t,e,i){var s=t.dpDiv.outerWidth(),n=t.dpDiv.outerHeight(),o=t.input?t.input.outerWidth():0,a=t.input?t.input.outerHeight():0,r=document.documentElement.clientWidth+(i?0:V(document).scrollLeft()),l=document.documentElement.clientHeight+(i?0:V(document).scrollTop());return e.left-=this._get(t,"isRTL")?s-o:0,e.left-=i&&e.left===t.input.offset().left?V(document).scrollLeft():0,e.top-=i&&e.top===t.input.offset().top+a?V(document).scrollTop():0,e.left-=Math.min(e.left,r<e.left+s&&s<r?Math.abs(e.left+s-r):0),e.top-=Math.min(e.top,l<e.top+n&&n<l?Math.abs(n+a):0),e},_findPos:function(t){for(var e=this._getInst(t),i=this._get(e,"isRTL");t&&("hidden"===t.type||1!==t.nodeType||V.expr.pseudos.hidden(t));)t=t[i?"previousSibling":"nextSibling"];return[(e=V(t).offset()).left,e.top]},_hideDatepicker:function(t){var e,i,s=this._curInst;!s||t&&s!==V.data(t,"datepicker")||this._datepickerShowing&&(t=this._get(s,"showAnim"),i=this._get(s,"duration"),e=function(){V.datepicker._tidyDialog(s)},V.effects&&V.effects.effect[t]?s.dpDiv.hide(t,V.datepicker._get(s,"showOptions"),i,e):s.dpDiv["slideDown"===t?"slideUp":"fadeIn"===t?"fadeOut":"hide"](t?i:null,e),t||e(),this._datepickerShowing=!1,(i=this._get(s,"onClose"))&&i.apply(s.input?s.input[0]:null,[s.input?s.input.val():"",s]),this._lastInput=null,this._inDialog&&(this._dialogInput.css({position:"absolute",left:"0",top:"-100px"}),V.blockUI)&&(V.unblockUI(),V("body").append(this.dpDiv)),this._inDialog=!1)},_tidyDialog:function(t){t.dpDiv.removeClass(this._dialogClass).off(".ui-datepicker-calendar")},_checkExternalClick:function(t){var e;V.datepicker._curInst&&(t=V(t.target),e=V.datepicker._getInst(t[0]),!(t[0].id===V.datepicker._mainDivId||0!==t.parents("#"+V.datepicker._mainDivId).length||t.hasClass(V.datepicker.markerClassName)||t.closest("."+V.datepicker._triggerClass).length||!V.datepicker._datepickerShowing||V.datepicker._inDialog&&V.blockUI)||t.hasClass(V.datepicker.markerClassName)&&V.datepicker._curInst!==e)&&V.datepicker._hideDatepicker()},_adjustDate:function(t,e,i){var t=V(t),s=this._getInst(t[0]);this._isDisabledDatepicker(t[0])||(this._adjustInstDate(s,e,i),this._updateDatepicker(s))},_gotoToday:function(t){var e,t=V(t),i=this._getInst(t[0]);this._get(i,"gotoCurrent")&&i.currentDay?(i.selectedDay=i.currentDay,i.drawMonth=i.selectedMonth=i.currentMonth,i.drawYear=i.selectedYear=i.currentYear):(e=new Date,i.selectedDay=e.getDate(),i.drawMonth=i.selectedMonth=e.getMonth(),i.drawYear=i.selectedYear=e.getFullYear()),this._notifyChange(i),this._adjustDate(t)},_selectMonthYear:function(t,e,i){var t=V(t),s=this._getInst(t[0]);s["selected"+("M"===i?"Month":"Year")]=s["draw"+("M"===i?"Month":"Year")]=parseInt(e.options[e.selectedIndex].value,10),this._notifyChange(s),this._adjustDate(t)},_selectDay:function(t,e,i,s){var n=V(t);V(s).hasClass(this._unselectableClass)||this._isDisabledDatepicker(n[0])||((n=this._getInst(n[0])).selectedDay=n.currentDay=parseInt(V("a",s).attr("data-date")),n.selectedMonth=n.currentMonth=e,n.selectedYear=n.currentYear=i,this._selectDate(t,this._formatDate(n,n.currentDay,n.currentMonth,n.currentYear)))},_clearDate:function(t){t=V(t);this._selectDate(t,"")},_selectDate:function(t,e){var i,t=V(t),t=this._getInst(t[0]);e=null!=e?e:this._formatDate(t),t.input&&t.input.val(e),this._updateAlternate(t),(i=this._get(t,"onSelect"))?i.apply(t.input?t.input[0]:null,[e,t]):t.input&&t.input.trigger("change"),t.inline?this._updateDatepicker(t):(this._hideDatepicker(),this._lastInput=t.input[0],"object"!=typeof t.input[0]&&t.input.trigger("focus"),this._lastInput=null)},_updateAlternate:function(t){var e,i,s=this._get(t,"altField");s&&(i=this._get(t,"altFormat")||this._get(t,"dateFormat"),e=this._getDate(t),i=this.formatDate(i,e,this._getFormatConfig(t)),V(document).find(s).val(i))},noWeekends:function(t){t=t.getDay();return[0<t&&t<6,""]},iso8601Week:function(t){var e,t=new Date(t.getTime());return t.setDate(t.getDate()+4-(t.getDay()||7)),e=t.getTime(),t.setMonth(0),t.setDate(1),Math.floor(Math.round((e-t)/864e5)/7)+1},parseDate:function(e,n,t){if(null==e||null==n)throw"Invalid arguments";if(""===(n="object"==typeof n?n.toString():n+""))return null;for(var i,s,o=0,a=(t?t.shortYearCutoff:null)||this._defaults.shortYearCutoff,a="string"!=typeof a?a:(new Date).getFullYear()%100+parseInt(a,10),r=(t?t.dayNamesShort:null)||this._defaults.dayNamesShort,l=(t?t.dayNames:null)||this._defaults.dayNames,h=(t?t.monthNamesShort:null)||this._defaults.monthNamesShort,c=(t?t.monthNames:null)||this._defaults.monthNames,u=-1,d=-1,p=-1,f=-1,g=!1,m=function(t){t=y+1<e.length&&e.charAt(y+1)===t;return t&&y++,t},_=function(t){var e=m(t),e="@"===t?14:"!"===t?20:"y"===t&&e?4:"o"===t?3:2,t=new RegExp("^\\d{"+("y"===t?e:1)+","+e+"}"),e=n.substring(o).match(t);if(e)return o+=e[0].length,parseInt(e[0],10);throw"Missing number at position "+o},v=function(t,e,i){var s=-1,t=V.map(m(t)?i:e,function(t,e){return[[e,t]]}).sort(function(t,e){return-(t[1].length-e[1].length)});if(V.each(t,function(t,e){var i=e[1];if(n.substr(o,i.length).toLowerCase()===i.toLowerCase())return s=e[0],o+=i.length,!1}),-1!==s)return s+1;throw"Unknown name at position "+o},b=function(){if(n.charAt(o)!==e.charAt(y))throw"Unexpected literal at position "+o;o++},y=0;y<e.length;y++)if(g)"'"!==e.charAt(y)||m("'")?b():g=!1;else switch(e.charAt(y)){case"d":p=_("d");break;case"D":v("D",r,l);break;case"o":f=_("o");break;case"m":d=_("m");break;case"M":d=v("M",h,c);break;case"y":u=_("y");break;case"@":u=(s=new Date(_("@"))).getFullYear(),d=s.getMonth()+1,p=s.getDate();break;case"!":u=(s=new Date((_("!")-this._ticksTo1970)/1e4)).getFullYear(),d=s.getMonth()+1,p=s.getDate();break;case"'":m("'")?b():g=!0;break;default:b()}if(o<n.length&&(t=n.substr(o),!/^\s+/.test(t)))throw"Extra/unparsed characters found in date: "+t;if(-1===u?u=(new Date).getFullYear():u<100&&(u+=(new Date).getFullYear()-(new Date).getFullYear()%100+(u<=a?0:-100)),-1<f)for(d=1,p=f;;){if(p<=(i=this._getDaysInMonth(u,d-1)))break;d++,p-=i}if((s=this._daylightSavingAdjust(new Date(u,d-1,p))).getFullYear()!==u||s.getMonth()+1!==d||s.getDate()!==p)throw"Invalid date";return s},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TICKS:"!",TIMESTAMP:"@",W3C:"yy-mm-dd",_ticksTo1970:24*(718685+Math.floor(492.5)-Math.floor(19.7)+Math.floor(4.925))*60*60*1e7,formatDate:function(e,t,i){if(!t)return"";function s(t,e,i){var s=""+e;if(c(t))for(;s.length<i;)s="0"+s;return s}function n(t,e,i,s){return(c(t)?s:i)[e]}var o,a=(i?i.dayNamesShort:null)||this._defaults.dayNamesShort,r=(i?i.dayNames:null)||this._defaults.dayNames,l=(i?i.monthNamesShort:null)||this._defaults.monthNamesShort,h=(i?i.monthNames:null)||this._defaults.monthNames,c=function(t){t=o+1<e.length&&e.charAt(o+1)===t;return t&&o++,t},u="",d=!1;if(t)for(o=0;o<e.length;o++)if(d)"'"!==e.charAt(o)||c("'")?u+=e.charAt(o):d=!1;else switch(e.charAt(o)){case"d":u+=s("d",t.getDate(),2);break;case"D":u+=n("D",t.getDay(),a,r);break;case"o":u+=s("o",Math.round((new Date(t.getFullYear(),t.getMonth(),t.getDate()).getTime()-new Date(t.getFullYear(),0,0).getTime())/864e5),3);break;case"m":u+=s("m",t.getMonth()+1,2);break;case"M":u+=n("M",t.getMonth(),l,h);break;case"y":u+=c("y")?t.getFullYear():(t.getFullYear()%100<10?"0":"")+t.getFullYear()%100;break;case"@":u+=t.getTime();break;case"!":u+=1e4*t.getTime()+this._ticksTo1970;break;case"'":c("'")?u+="'":d=!0;break;default:u+=e.charAt(o)}return u},_possibleChars:function(e){for(var t="",i=!1,s=function(t){t=n+1<e.length&&e.charAt(n+1)===t;return t&&n++,t},n=0;n<e.length;n++)if(i)"'"!==e.charAt(n)||s("'")?t+=e.charAt(n):i=!1;else switch(e.charAt(n)){case"d":case"m":case"y":case"@":t+="0123456789";break;case"D":case"M":return null;case"'":s("'")?t+="'":i=!0;break;default:t+=e.charAt(n)}return t},_get:function(t,e){return(void 0!==t.settings[e]?t.settings:this._defaults)[e]},_setDateFromField:function(t,e){if(t.input.val()!==t.lastVal){var i=this._get(t,"dateFormat"),s=t.lastVal=t.input?t.input.val():null,n=this._getDefaultDate(t),o=n,a=this._getFormatConfig(t);try{o=this.parseDate(i,s,a)||n}catch(t){s=e?"":s}t.selectedDay=o.getDate(),t.drawMonth=t.selectedMonth=o.getMonth(),t.drawYear=t.selectedYear=o.getFullYear(),t.currentDay=s?o.getDate():0,t.currentMonth=s?o.getMonth():0,t.currentYear=s?o.getFullYear():0,this._adjustInstDate(t)}},_getDefaultDate:function(t){return this._restrictMinMax(t,this._determineDate(t,this._get(t,"defaultDate"),new Date))},_determineDate:function(r,t,e){var i,s=null==t||""===t?e:"string"==typeof t?(t=>{try{return V.datepicker.parseDate(V.datepicker._get(r,"dateFormat"),t,V.datepicker._getFormatConfig(r))}catch(t){}for(var e=(t.toLowerCase().match(/^c/)?V.datepicker._getDate(r):null)||new Date,i=e.getFullYear(),s=e.getMonth(),n=e.getDate(),o=/([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,a=o.exec(t);a;){switch(a[2]||"d"){case"d":case"D":n+=parseInt(a[1],10);break;case"w":case"W":n+=7*parseInt(a[1],10);break;case"m":case"M":s+=parseInt(a[1],10),n=Math.min(n,V.datepicker._getDaysInMonth(i,s));break;case"y":case"Y":i+=parseInt(a[1],10),n=Math.min(n,V.datepicker._getDaysInMonth(i,s))}a=o.exec(t)}return new Date(i,s,n)})(t):"number"==typeof t?isNaN(t)?e:(s=t,(i=new Date).setDate(i.getDate()+s),i):new Date(t.getTime());return(s=s&&"Invalid Date"===s.toString()?e:s)&&(s.setHours(0),s.setMinutes(0),s.setSeconds(0),s.setMilliseconds(0)),this._daylightSavingAdjust(s)},_daylightSavingAdjust:function(t){return t?(t.setHours(12<t.getHours()?t.getHours()+2:0),t):null},_setDate:function(t,e,i){var s=!e,n=t.selectedMonth,o=t.selectedYear,e=this._restrictMinMax(t,this._determineDate(t,e,new Date));t.selectedDay=t.currentDay=e.getDate(),t.drawMonth=t.selectedMonth=t.currentMonth=e.getMonth(),t.drawYear=t.selectedYear=t.currentYear=e.getFullYear(),n===t.selectedMonth&&o===t.selectedYear||i||this._notifyChange(t),this._adjustInstDate(t),t.input&&t.input.val(s?"":this._formatDate(t))},_getDate:function(t){return!t.currentYear||t.input&&""===t.input.val()?null:this._daylightSavingAdjust(new Date(t.currentYear,t.currentMonth,t.currentDay))},_attachHandlers:function(t){var e=this._get(t,"stepMonths"),i="#"+t.id.replace(/\\\\/g,"\\");t.dpDiv.find("[data-handler]").map(function(){var t={prev:function(){V.datepicker._adjustDate(i,-e,"M")},next:function(){V.datepicker._adjustDate(i,+e,"M")},hide:function(){V.datepicker._hideDatepicker()},today:function(){V.datepicker._gotoToday(i)},selectDay:function(){return V.datepicker._selectDay(i,+this.getAttribute("data-month"),+this.getAttribute("data-year"),this),!1},selectMonth:function(){return V.datepicker._selectMonthYear(i,this,"M"),!1},selectYear:function(){return V.datepicker._selectMonthYear(i,this,"Y"),!1}};V(this).on(this.getAttribute("data-event"),t[this.getAttribute("data-handler")])})},_generateHTML:function(t){var e,i,s,n,o,N,W,F,L,a,r,R,l,h,c,u,d,p,f,g,m,_,Y,v,b,B,y,j,q,w,x,k,C=new Date,K=this._daylightSavingAdjust(new Date(C.getFullYear(),C.getMonth(),C.getDate())),D=this._get(t,"isRTL"),C=this._get(t,"showButtonPanel"),I=this._get(t,"hideIfNoPrevNext"),T=this._get(t,"navigationAsDateFormat"),P=this._getNumberOfMonths(t),M=this._get(t,"showCurrentAtPos"),S=this._get(t,"stepMonths"),U=1!==P[0]||1!==P[1],H=this._daylightSavingAdjust(t.currentDay?new Date(t.currentYear,t.currentMonth,t.currentDay):new Date(9999,9,9)),z=this._getMinMaxDate(t,"min"),O=this._getMinMaxDate(t,"max"),A=t.drawMonth-M,E=t.drawYear;if(A<0&&(A+=12,E--),O)for(e=this._daylightSavingAdjust(new Date(O.getFullYear(),O.getMonth()-P[0]*P[1]+1,O.getDate())),e=z&&e<z?z:e;this._daylightSavingAdjust(new Date(E,A,1))>e;)--A<0&&(A=11,E--);for(t.drawMonth=A,t.drawYear=E,M=this._get(t,"prevText"),M=T?this.formatDate(M,this._daylightSavingAdjust(new Date(E,A-S,1)),this._getFormatConfig(t)):M,i=this._canAdjustMonth(t,-1,E,A)?V("<a>").attr({class:"ui-datepicker-prev ui-corner-all","data-handler":"prev","data-event":"click",title:M}).append(V("<span>").addClass("ui-icon ui-icon-circle-triangle-"+(D?"e":"w")).text(M))[0].outerHTML:I?"":V("<a>").attr({class:"ui-datepicker-prev ui-corner-all ui-state-disabled",title:M}).append(V("<span>").addClass("ui-icon ui-icon-circle-triangle-"+(D?"e":"w")).text(M))[0].outerHTML,M=this._get(t,"nextText"),M=T?this.formatDate(M,this._daylightSavingAdjust(new Date(E,A+S,1)),this._getFormatConfig(t)):M,s=this._canAdjustMonth(t,1,E,A)?V("<a>").attr({class:"ui-datepicker-next ui-corner-all","data-handler":"next","data-event":"click",title:M}).append(V("<span>").addClass("ui-icon ui-icon-circle-triangle-"+(D?"w":"e")).text(M))[0].outerHTML:I?"":V("<a>").attr({class:"ui-datepicker-next ui-corner-all ui-state-disabled",title:M}).append(V("<span>").attr("class","ui-icon ui-icon-circle-triangle-"+(D?"w":"e")).text(M))[0].outerHTML,S=this._get(t,"currentText"),I=this._get(t,"gotoCurrent")&&t.currentDay?H:K,S=T?this.formatDate(S,I,this._getFormatConfig(t)):S,M="",t.inline||(M=V("<button>").attr({type:"button",class:"ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all","data-handler":"hide","data-event":"click"}).text(this._get(t,"closeText"))[0].outerHTML),T="",C&&(T=V("<div class='ui-datepicker-buttonpane ui-widget-content'>").append(D?M:"").append(this._isInRange(t,I)?V("<button>").attr({type:"button",class:"ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all","data-handler":"today","data-event":"click"}).text(S):"").append(D?"":M)[0].outerHTML),n=parseInt(this._get(t,"firstDay"),10),n=isNaN(n)?0:n,o=this._get(t,"showWeek"),N=this._get(t,"dayNames"),W=this._get(t,"dayNamesMin"),F=this._get(t,"monthNames"),L=this._get(t,"monthNamesShort"),a=this._get(t,"beforeShowDay"),r=this._get(t,"showOtherMonths"),R=this._get(t,"selectOtherMonths"),l=this._getDefaultDate(t),h="",u=0;u<P[0];u++){for(d="",this.maxRows=4,p=0;p<P[1];p++){if(f=this._daylightSavingAdjust(new Date(E,A,t.selectedDay)),g=" ui-corner-all",m="",U){if(m+="<div class='ui-datepicker-group",1<P[1])switch(p){case 0:m+=" ui-datepicker-group-first",g=" ui-corner-"+(D?"right":"left");break;case P[1]-1:m+=" ui-datepicker-group-last",g=" ui-corner-"+(D?"left":"right");break;default:m+=" ui-datepicker-group-middle",g=""}m+="'>"}for(m+="<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix"+g+"'>"+(/all|left/.test(g)&&0===u?D?s:i:"")+(/all|right/.test(g)&&0===u?D?i:s:"")+this._generateMonthYearHeader(t,A,E,z,O,0<u||0<p,F,L)+"</div><table class='ui-datepicker-calendar'><thead><tr>",_=o?"<th class='ui-datepicker-week-col'>"+this._get(t,"weekHeader")+"</th>":"",c=0;c<7;c++)_+="<th scope='col'"+(5<=(c+n+6)%7?" class='ui-datepicker-week-end'":"")+"><span title='"+N[Y=(c+n)%7]+"'>"+W[Y]+"</span></th>";for(m+=_+"</tr></thead><tbody>",b=this._getDaysInMonth(E,A),E===t.selectedYear&&A===t.selectedMonth&&(t.selectedDay=Math.min(t.selectedDay,b)),v=(this._getFirstDayOfMonth(E,A)-n+7)%7,b=Math.ceil((v+b)/7),B=U&&this.maxRows>b?this.maxRows:b,this.maxRows=B,y=this._daylightSavingAdjust(new Date(E,A,1-v)),j=0;j<B;j++){for(m+="<tr>",q=o?"<td class='ui-datepicker-week-col'>"+this._get(t,"calculateWeek")(y)+"</td>":"",c=0;c<7;c++)w=a?a.apply(t.input?t.input[0]:null,[y]):[!0,""],k=(x=y.getMonth()!==A)&&!R||!w[0]||z&&y<z||O&&O<y,q+="<td class='"+(5<=(c+n+6)%7?" ui-datepicker-week-end":"")+(x?" ui-datepicker-other-month":"")+(y.getTime()===f.getTime()&&A===t.selectedMonth&&t._keyEvent||l.getTime()===y.getTime()&&l.getTime()===f.getTime()?" "+this._dayOverClass:"")+(k?" "+this._unselectableClass+" ui-state-disabled":"")+(x&&!r?"":" "+w[1]+(y.getTime()===H.getTime()?" "+this._currentClass:"")+(y.getTime()===K.getTime()?" ui-datepicker-today":""))+"'"+(x&&!r||!w[2]?"":" title='"+w[2].replace(/'/g,"&#39;")+"'")+(k?"":" data-handler='selectDay' data-event='click' data-month='"+y.getMonth()+"' data-year='"+y.getFullYear()+"'")+">"+(x&&!r?"&#xa0;":k?"<span class='ui-state-default'>"+y.getDate()+"</span>":"<a class='ui-state-default"+(y.getTime()===K.getTime()?" ui-state-highlight":"")+(y.getTime()===H.getTime()?" ui-state-active":"")+(x?" ui-priority-secondary":"")+"' href='#' aria-current='"+(y.getTime()===H.getTime()?"true":"false")+"' data-date='"+y.getDate()+"'>"+y.getDate()+"</a>")+"</td>",y.setDate(y.getDate()+1),y=this._daylightSavingAdjust(y);m+=q+"</tr>"}11<++A&&(A=0,E++),d+=m+="</tbody></table>"+(U?"</div>"+(0<P[0]&&p===P[1]-1?"<div class='ui-datepicker-row-break'></div>":""):"")}h+=d}return h+=T,t._keyEvent=!1,h},_generateMonthYearHeader:function(t,e,i,s,n,o,a,r){var l,h,c,u,d,p,f=this._get(t,"changeMonth"),g=this._get(t,"changeYear"),m=this._get(t,"showMonthAfterYear"),_=this._get(t,"selectMonthLabel"),v=this._get(t,"selectYearLabel"),b="<div class='ui-datepicker-title'>",y="";if(o||!f)y+="<span class='ui-datepicker-month'>"+a[e]+"</span>";else{for(l=s&&s.getFullYear()===i,h=n&&n.getFullYear()===i,y+="<select class='ui-datepicker-month' aria-label='"+_+"' data-handler='selectMonth' data-event='change'>",c=0;c<12;c++)(!l||c>=s.getMonth())&&(!h||c<=n.getMonth())&&(y+="<option value='"+c+"'"+(c===e?" selected='selected'":"")+">"+r[c]+"</option>");y+="</select>"}if(m||(b+=y+(!o&&f&&g?"":"&#xa0;")),!t.yearshtml)if(t.yearshtml="",o||!g)b+="<span class='ui-datepicker-year'>"+i+"</span>";else{for(a=this._get(t,"yearRange").split(":"),u=(new Date).getFullYear(),d=(_=function(t){t=t.match(/c[+\-].*/)?i+parseInt(t.substring(1),10):t.match(/[+\-].*/)?u+parseInt(t,10):parseInt(t,10);return isNaN(t)?u:t})(a[0]),p=Math.max(d,_(a[1]||"")),d=s?Math.max(d,s.getFullYear()):d,p=n?Math.min(p,n.getFullYear()):p,t.yearshtml+="<select class='ui-datepicker-year' aria-label='"+v+"' data-handler='selectYear' data-event='change'>";d<=p;d++)t.yearshtml+="<option value='"+d+"'"+(d===i?" selected='selected'":"")+">"+d+"</option>";t.yearshtml+="</select>",b+=t.yearshtml,t.yearshtml=null}return b+=this._get(t,"yearSuffix"),m&&(b+=(!o&&f&&g?"":"&#xa0;")+y),b+="</div>"},_adjustInstDate:function(t,e,i){var s=t.selectedYear+("Y"===i?e:0),n=t.selectedMonth+("M"===i?e:0),e=Math.min(t.selectedDay,this._getDaysInMonth(s,n))+("D"===i?e:0),s=this._restrictMinMax(t,this._daylightSavingAdjust(new Date(s,n,e)));t.selectedDay=s.getDate(),t.drawMonth=t.selectedMonth=s.getMonth(),t.drawYear=t.selectedYear=s.getFullYear(),"M"!==i&&"Y"!==i||this._notifyChange(t)},_restrictMinMax:function(t,e){var i=this._getMinMaxDate(t,"min"),t=this._getMinMaxDate(t,"max"),i=i&&e<i?i:e;return t&&t<i?t:i},_notifyChange:function(t){var e=this._get(t,"onChangeMonthYear");e&&e.apply(t.input?t.input[0]:null,[t.selectedYear,t.selectedMonth+1,t])},_getNumberOfMonths:function(t){t=this._get(t,"numberOfMonths");return null==t?[1,1]:"number"==typeof t?[1,t]:t},_getMinMaxDate:function(t,e){return this._determineDate(t,this._get(t,e+"Date"),null)},_getDaysInMonth:function(t,e){return 32-this._daylightSavingAdjust(new Date(t,e,32)).getDate()},_getFirstDayOfMonth:function(t,e){return new Date(t,e,1).getDay()},_canAdjustMonth:function(t,e,i,s){var n=this._getNumberOfMonths(t),i=this._daylightSavingAdjust(new Date(i,s+(e<0?e:n[0]*n[1]),1));return e<0&&i.setDate(this._getDaysInMonth(i.getFullYear(),i.getMonth())),this._isInRange(t,i)},_isInRange:function(t,e){var i,s=this._getMinMaxDate(t,"min"),n=this._getMinMaxDate(t,"max"),o=null,a=null,t=this._get(t,"yearRange");return t&&(t=t.split(":"),i=(new Date).getFullYear(),o=parseInt(t[0],10),a=parseInt(t[1],10),t[0].match(/[+\-].*/)&&(o+=i),t[1].match(/[+\-].*/))&&(a+=i),(!s||e.getTime()>=s.getTime())&&(!n||e.getTime()<=n.getTime())&&(!o||e.getFullYear()>=o)&&(!a||e.getFullYear()<=a)},_getFormatConfig:function(t){var e=this._get(t,"shortYearCutoff");return{shortYearCutoff:"string"!=typeof e?e:(new Date).getFullYear()%100+parseInt(e,10),dayNamesShort:this._get(t,"dayNamesShort"),dayNames:this._get(t,"dayNames"),monthNamesShort:this._get(t,"monthNamesShort"),monthNames:this._get(t,"monthNames")}},_formatDate:function(t,e,i,s){e||(t.currentDay=t.selectedDay,t.currentMonth=t.selectedMonth,t.currentYear=t.selectedYear);s=e?"object"==typeof e?e:this._daylightSavingAdjust(new Date(s,i,e)):this._daylightSavingAdjust(new Date(t.currentYear,t.currentMonth,t.currentDay));return this.formatDate(this._get(t,"dateFormat"),s,this._getFormatConfig(t))}}),V.fn.datepicker=function(t){if(!this.length)return this;V.datepicker.initialized||(V(document).on("mousedown",V.datepicker._checkExternalClick),V.datepicker.initialized=!0),0===V("#"+V.datepicker._mainDivId).length&&V("body").append(V.datepicker.dpDiv);var e=Array.prototype.slice.call(arguments,1);return"string"==typeof t&&("isDisabled"===t||"getDate"===t||"widget"===t)||"option"===t&&2===arguments.length&&"string"==typeof arguments[1]?V.datepicker["_"+t+"Datepicker"].apply(V.datepicker,[this[0]].concat(e)):this.each(function(){"string"==typeof t?V.datepicker["_"+t+"Datepicker"].apply(V.datepicker,[this].concat(e)):V.datepicker._attachDatepicker(this,t)})},V.datepicker=new nt,V.datepicker.initialized=!1,V.datepicker.uuid=(new Date).getTime(),V.datepicker.version="1.14.1";var z=!1;V(document).on("mouseup",function(){z=!1}),V.widget("ui.mouse",{version:"1.14.1",options:{cancel:"input, textarea, button, select, option",distance:1,delay:0},_mouseInit:function(){var e=this;this.element.on("mousedown."+this.widgetName,function(t){return e._mouseDown(t)}).on("click."+this.widgetName,function(t){if(!0===V.data(t.target,e.widgetName+".preventClickEvent"))return V.removeData(t.target,e.widgetName+".preventClickEvent"),t.stopImmediatePropagation(),!1}),this.started=!1},_mouseDestroy:function(){this.element.off("."+this.widgetName),this._mouseMoveDelegate&&this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(t){var e,i,s;if(!z)return this._mouseMoved=!1,this._mouseStarted&&this._mouseUp(t),i=1===(this._mouseDownEvent=t).which,s="string"==typeof(e=this).options.cancel&&V(t.target).closest(this.options.cancel).length,i&&!s&&this._mouseCapture(t)&&(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){e.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=!1!==this._mouseStart(t),!this._mouseStarted)?t.preventDefault():(!0===V.data(t.target,this.widgetName+".preventClickEvent")&&V.removeData(t.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(t){return e._mouseMove(t)},this._mouseUpDelegate=function(t){return e._mouseUp(t)},this.document.on("mousemove."+this.widgetName,this._mouseMoveDelegate).on("mouseup."+this.widgetName,this._mouseUpDelegate),t.preventDefault(),z=!0)),!0},_mouseMove:function(t){if(this._mouseMoved&&!t.which)if(t.originalEvent.altKey||t.originalEvent.ctrlKey||t.originalEvent.metaKey||t.originalEvent.shiftKey)this.ignoreMissingWhich=!0;else if(!this.ignoreMissingWhich)return this._mouseUp(t);return(t.which||t.button)&&(this._mouseMoved=!0),this._mouseStarted?(this._mouseDrag(t),t.preventDefault()):(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=!1!==this._mouseStart(this._mouseDownEvent,t),this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)),!this._mouseStarted)},_mouseUp:function(t){this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,t.target===this._mouseDownEvent.target&&V.data(t.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(t)),this._mouseDelayTimer&&(clearTimeout(this._mouseDelayTimer),delete this._mouseDelayTimer),this.ignoreMissingWhich=!1,z=!1,t.preventDefault()},_mouseDistanceMet:function(t){return Math.max(Math.abs(this._mouseDownEvent.pageX-t.pageX),Math.abs(this._mouseDownEvent.pageY-t.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}}),V.ui.plugin={add:function(t,e,i){var s,n=V.ui[t].prototype;for(s in i)n.plugins[s]=n.plugins[s]||[],n.plugins[s].push([e,i[s]])},call:function(t,e,i,s){var n,o=t.plugins[e];if(o&&(s||t.element[0].parentNode&&11!==t.element[0].parentNode.nodeType))for(n=0;n<o.length;n++)t.options[o[n][0]]&&o[n][1].apply(t.element,i)}},V.widget("ui.draggable",V.ui.mouse,{version:"1.14.1",widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1,drag:null,start:null,stop:null},_create:function(){"original"===this.options.helper&&this._setPositionRelative(),this.options.addClasses&&this._addClass("ui-draggable"),this._setHandleClassName(),this._mouseInit()},_setOption:function(t,e){this._super(t,e),"handle"===t&&(this._removeHandleClassName(),this._setHandleClassName())},_destroy:function(){(this.helper||this.element).is(".ui-draggable-dragging")?this.destroyOnClear=!0:(this._removeHandleClassName(),this._mouseDestroy())},_mouseCapture:function(t){var e=this.options;return!(this.helper||e.disabled||0<V(t.target).closest(".ui-resizable-handle").length||(this.handle=this._getHandle(t),!this.handle)||(this._blurActiveElement(t),this._blockFrames(!0===e.iframeFix?"iframe":e.iframeFix),0))},_blockFrames:function(t){this.iframeBlocks=this.document.find(t).map(function(){var t=V(this);return V("<div>").css("position","absolute").appendTo(t.parent()).outerWidth(t.outerWidth()).outerHeight(t.outerHeight()).offset(t.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_blurActiveElement:function(t){var e=this.document[0].activeElement;V(t.target).closest(e).length||V(e).trigger("blur")},_mouseStart:function(t){var e=this.options;return this.helper=this._createHelper(t),this._addClass(this.helper,"ui-draggable-dragging"),this._cacheHelperProportions(),V.ui.ddmanager&&(V.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(!0),this.offsetParent=this.helper.offsetParent(),this.hasFixedAncestor=0<this.helper.parents().filter(function(){return"fixed"===V(this).css("position")}).length,this.positionAbs=this.element.offset(),this._refreshOffsets(t),this.originalPosition=this.position=this._generatePosition(t,!1),this.originalPageX=t.pageX,this.originalPageY=t.pageY,e.cursorAt&&this._adjustOffsetFromHelper(e.cursorAt),this._setContainment(),!1===this._trigger("start",t)?(this._clear(),!1):(this._cacheHelperProportions(),V.ui.ddmanager&&!e.dropBehaviour&&V.ui.ddmanager.prepareOffsets(this,t),this._mouseDrag(t,!0),V.ui.ddmanager&&V.ui.ddmanager.dragStart(this,t),!0)},_refreshOffsets:function(t){this.offset={top:this.positionAbs.top-this.margins.top,left:this.positionAbs.left-this.margins.left,scroll:!1,parent:this._getParentOffset(),relative:this._getRelativeOffset()},this.offset.click={left:t.pageX-this.offset.left,top:t.pageY-this.offset.top}},_mouseDrag:function(t,e){if(this.hasFixedAncestor&&(this.offset.parent=this._getParentOffset()),this.position=this._generatePosition(t,!0),this.positionAbs=this._convertPositionTo("absolute"),!e){e=this._uiHash();if(!1===this._trigger("drag",t,e))return this._mouseUp(new V.Event("mouseup",t)),!1;this.position=e.position}return this.helper[0].style.left=this.position.left+"px",this.helper[0].style.top=this.position.top+"px",V.ui.ddmanager&&V.ui.ddmanager.drag(this,t),!1},_mouseStop:function(t){var e=this,i=!1;return V.ui.ddmanager&&!this.options.dropBehaviour&&(i=V.ui.ddmanager.drop(this,t)),this.dropped&&(i=this.dropped,this.dropped=!1),"invalid"===this.options.revert&&!i||"valid"===this.options.revert&&i||!0===this.options.revert||"function"==typeof this.options.revert&&this.options.revert.call(this.element,i)?V(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){!1!==e._trigger("stop",t)&&e._clear()}):!1!==this._trigger("stop",t)&&this._clear(),!1},_mouseUp:function(t){return this._unblockFrames(),V.ui.ddmanager&&V.ui.ddmanager.dragStop(this,t),this.handleElement.is(t.target)&&this.element.trigger("focus"),V.ui.mouse.prototype._mouseUp.call(this,t)},cancel:function(){return this.helper.is(".ui-draggable-dragging")?this._mouseUp(new V.Event("mouseup",{target:this.element[0]})):this._clear(),this},_getHandle:function(t){return!this.options.handle||!!V(t.target).closest(this.element.find(this.options.handle)).length},_setHandleClassName:function(){this.handleElement=this.options.handle?this.element.find(this.options.handle):this.element,this._addClass(this.handleElement,"ui-draggable-handle")},_removeHandleClassName:function(){this._removeClass(this.handleElement,"ui-draggable-handle")},_createHelper:function(t){var e=this.options,i="function"==typeof e.helper,t=i?V(e.helper.apply(this.element[0],[t])):"clone"===e.helper?this.element.clone().removeAttr("id"):this.element;return t.parents("body").length||t.appendTo("parent"===e.appendTo?this.element[0].parentNode:e.appendTo),i&&t[0]===this.element[0]&&this._setPositionRelative(),t[0]===this.element[0]||/(fixed|absolute)/.test(t.css("position"))||t.css("position","absolute"),t},_setPositionRelative:function(){/^(?:r|a|f)/.test(this.element.css("position"))||(this.element[0].style.position="relative")},_adjustOffsetFromHelper:function(t){"string"==typeof t&&(t=t.split(" ")),"left"in(t=Array.isArray(t)?{left:+t[0],top:+t[1]||0}:t)&&(this.offset.click.left=t.left+this.margins.left),"right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left),"top"in t&&(this.offset.click.top=t.top+this.margins.top),"bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)},_isRootNode:function(t){return/(html|body)/i.test(t.tagName)||t===this.document[0]},_getParentOffset:function(){var t=this.offsetParent.offset(),e=this.document[0];return"absolute"===this.cssPosition&&this.scrollParent[0]!==e&&V.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),{top:(t=this._isRootNode(this.offsetParent[0])?{top:0,left:0}:t).top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){var t,e;return"relative"!==this.cssPosition?{top:0,left:0}:(t=this.element.position(),e=this._isRootNode(this.scrollParent[0]),{top:t.top-(parseInt(this.helper.css("top"),10)||0)+(e?0:this.scrollParent.scrollTop()),left:t.left-(parseInt(this.helper.css("left"),10)||0)+(e?0:this.scrollParent.scrollLeft())})},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t,e=this.options,i=this.document[0];this.relativeContainer=null,e.containment?"window"===e.containment?this.containment=[V(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,V(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,V(window).scrollLeft()+V(window).width()-this.helperProportions.width-this.margins.left,V(window).scrollTop()+(V(window).height()||i.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]:"document"===e.containment?this.containment=[0,0,V(i).width()-this.helperProportions.width-this.margins.left,(V(i).height()||i.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]:e.containment.constructor===Array?this.containment=e.containment:("parent"===e.containment&&(e.containment=this.helper[0].parentNode),(e=(i=V(e.containment))[0])&&(t=/(scroll|auto)/.test(i.css("overflow")),this.containment=[(parseInt(i.css("borderLeftWidth"),10)||0)+(parseInt(i.css("paddingLeft"),10)||0),(parseInt(i.css("borderTopWidth"),10)||0)+(parseInt(i.css("paddingTop"),10)||0),(t?Math.max(e.scrollWidth,e.offsetWidth):e.offsetWidth)-(parseInt(i.css("borderRightWidth"),10)||0)-(parseInt(i.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(t?Math.max(e.scrollHeight,e.offsetHeight):e.offsetHeight)-(parseInt(i.css("borderBottomWidth"),10)||0)-(parseInt(i.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relativeContainer=i)):this.containment=null},_convertPositionTo:function(t,e){e=e||this.position;var t="absolute"===t?1:-1,i=this._isRootNode(this.scrollParent[0]);return{top:e.top+this.offset.relative.top*t+this.offset.parent.top*t-("fixed"===this.cssPosition?-this.offset.scroll.top:i?0:this.offset.scroll.top)*t,left:e.left+this.offset.relative.left*t+this.offset.parent.left*t-("fixed"===this.cssPosition?-this.offset.scroll.left:i?0:this.offset.scroll.left)*t}},_generatePosition:function(t,e){var i,s=this.options,n=this._isRootNode(this.scrollParent[0]),o=t.pageX,a=t.pageY;return n&&this.offset.scroll||(this.offset.scroll={top:this.scrollParent.scrollTop(),left:this.scrollParent.scrollLeft()}),{top:(a=e&&(this.containment&&(i=this.relativeContainer?(e=this.relativeContainer.offset(),[this.containment[0]+e.left,this.containment[1]+e.top,this.containment[2]+e.left,this.containment[3]+e.top]):this.containment,t.pageX-this.offset.click.left<i[0]&&(o=i[0]+this.offset.click.left),t.pageY-this.offset.click.top<i[1]&&(a=i[1]+this.offset.click.top),t.pageX-this.offset.click.left>i[2]&&(o=i[2]+this.offset.click.left),t.pageY-this.offset.click.top>i[3])&&(a=i[3]+this.offset.click.top),s.grid&&(e=s.grid[1]?this.originalPageY+Math.round((a-this.originalPageY)/s.grid[1])*s.grid[1]:this.originalPageY,a=!i||e-this.offset.click.top>=i[1]||e-this.offset.click.top>i[3]?e:e-this.offset.click.top>=i[1]?e-s.grid[1]:e+s.grid[1],t=s.grid[0]?this.originalPageX+Math.round((o-this.originalPageX)/s.grid[0])*s.grid[0]:this.originalPageX,o=!i||t-this.offset.click.left>=i[0]||t-this.offset.click.left>i[2]?t:t-this.offset.click.left>=i[0]?t-s.grid[0]:t+s.grid[0]),"y"===s.axis&&(o=this.originalPageX),"x"===s.axis)?this.originalPageY:a)-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.offset.scroll.top:n?0:this.offset.scroll.top),left:o-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.offset.scroll.left:n?0:this.offset.scroll.left)}},_clear:function(){this._removeClass(this.helper,"ui-draggable-dragging"),this.helper[0]===this.element[0]||this.cancelHelperRemoval||this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1,this.destroyOnClear&&this.destroy()},_trigger:function(t,e,i){return i=i||this._uiHash(),V.ui.plugin.call(this,t,[e,i,this],!0),/^(drag|start|stop)/.test(t)&&(this.positionAbs=this._convertPositionTo("absolute"),i.offset=this.positionAbs),V.Widget.prototype._trigger.call(this,t,e,i)},plugins:{},_uiHash:function(){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),V.ui.plugin.add("draggable","connectToSortable",{start:function(e,t,i){var s=V.extend({},t,{item:i.element});i.sortables=[],V(i.options.connectToSortable).each(function(){var t=V(this).sortable("instance");t&&!t.options.disabled&&(i.sortables.push(t),t.refreshPositions(),t._trigger("activate",e,s))})},stop:function(e,t,i){var s=V.extend({},t,{item:i.element});i.cancelHelperRemoval=!1,V.each(i.sortables,function(){var t=this;t.isOver?(t.isOver=0,i.cancelHelperRemoval=!0,t.cancelHelperRemoval=!1,t._storedCSS={position:t.placeholder.css("position"),top:t.placeholder.css("top"),left:t.placeholder.css("left")},t._mouseStop(e),t.options.helper=t.options._helper):(t.cancelHelperRemoval=!0,t._trigger("deactivate",e,s))})},drag:function(i,s,n){V.each(n.sortables,function(){var t=!1,e=this;e.positionAbs=n.positionAbs,e.helperProportions=n.helperProportions,e.offset.click=n.offset.click,e._intersectsWith(e.containerCache)&&(t=!0,V.each(n.sortables,function(){return this.positionAbs=n.positionAbs,this.helperProportions=n.helperProportions,this.offset.click=n.offset.click,t=this!==e&&this._intersectsWith(this.containerCache)&&V.contains(e.element[0],this.element[0])?!1:t})),t?(e.isOver||(e.isOver=1,n._parent=s.helper.parent(),e.currentItem=s.helper.appendTo(e.element).data("ui-sortable-item",!0),e.options._helper=e.options.helper,e.options.helper=function(){return s.helper[0]},i.target=e.currentItem[0],e._mouseCapture(i,!0),e._mouseStart(i,!0,!0),e.offset.click.top=n.offset.click.top,e.offset.click.left=n.offset.click.left,e.offset.parent.left-=n.offset.parent.left-e.offset.parent.left,e.offset.parent.top-=n.offset.parent.top-e.offset.parent.top,n._trigger("toSortable",i),n.dropped=e.element,V.each(n.sortables,function(){this.refreshPositions()}),n.currentItem=n.element,e.fromOutside=n),e.currentItem&&(e._mouseDrag(i),s.position=e.position)):e.isOver&&(e.isOver=0,e.cancelHelperRemoval=!0,e.options._revert=e.options.revert,e.options.revert=!1,e._trigger("out",i,e._uiHash(e)),e._mouseStop(i,!0),e.options.revert=e.options._revert,e.options.helper=e.options._helper,e.placeholder&&e.placeholder.remove(),s.helper.appendTo(n._parent),n._refreshOffsets(i),s.position=n._generatePosition(i,!0),n._trigger("fromSortable",i),n.dropped=!1,V.each(n.sortables,function(){this.refreshPositions()}))})}}),V.ui.plugin.add("draggable","cursor",{start:function(t,e,i){var s=V("body"),i=i.options;s.css("cursor")&&(i._cursor=s.css("cursor")),s.css("cursor",i.cursor)},stop:function(t,e,i){i=i.options;i._cursor&&V("body").css("cursor",i._cursor)}}),V.ui.plugin.add("draggable","opacity",{start:function(t,e,i){e=V(e.helper),i=i.options;e.css("opacity")&&(i._opacity=e.css("opacity")),e.css("opacity",i.opacity)},stop:function(t,e,i){i=i.options;i._opacity&&V(e.helper).css("opacity",i._opacity)}}),V.ui.plugin.add("draggable","scroll",{start:function(t,e,i){i.scrollParentNotHidden||(i.scrollParentNotHidden=i.helper.scrollParent(!1)),i.scrollParentNotHidden[0]!==i.document[0]&&"HTML"!==i.scrollParentNotHidden[0].tagName&&(i.overflowOffset=i.scrollParentNotHidden.offset())},drag:function(t,e,i){var s=i.options,n=!1,o=i.scrollParentNotHidden[0],a=i.document[0];o!==a&&"HTML"!==o.tagName?(s.axis&&"x"===s.axis||(i.overflowOffset.top+o.offsetHeight-t.pageY<s.scrollSensitivity?o.scrollTop=n=o.scrollTop+s.scrollSpeed:t.pageY-i.overflowOffset.top<s.scrollSensitivity&&(o.scrollTop=n=o.scrollTop-s.scrollSpeed)),s.axis&&"y"===s.axis||(i.overflowOffset.left+o.offsetWidth-t.pageX<s.scrollSensitivity?o.scrollLeft=n=o.scrollLeft+s.scrollSpeed:t.pageX-i.overflowOffset.left<s.scrollSensitivity&&(o.scrollLeft=n=o.scrollLeft-s.scrollSpeed))):(s.axis&&"x"===s.axis||(t.pageY-V(a).scrollTop()<s.scrollSensitivity?n=V(a).scrollTop(V(a).scrollTop()-s.scrollSpeed):V(window).height()-(t.pageY-V(a).scrollTop())<s.scrollSensitivity&&(n=V(a).scrollTop(V(a).scrollTop()+s.scrollSpeed))),s.axis&&"y"===s.axis||(t.pageX-V(a).scrollLeft()<s.scrollSensitivity?n=V(a).scrollLeft(V(a).scrollLeft()-s.scrollSpeed):V(window).width()-(t.pageX-V(a).scrollLeft())<s.scrollSensitivity&&(n=V(a).scrollLeft(V(a).scrollLeft()+s.scrollSpeed)))),!1!==n&&V.ui.ddmanager&&!s.dropBehaviour&&V.ui.ddmanager.prepareOffsets(i,t)}}),V.ui.plugin.add("draggable","snap",{start:function(t,e,i){var s=i.options;i.snapElements=[],V(s.snap.constructor!==String?s.snap.items||":data(ui-draggable)":s.snap).each(function(){var t=V(this),e=t.offset();this!==i.element[0]&&i.snapElements.push({item:this,width:t.outerWidth(),height:t.outerHeight(),top:e.top,left:e.left})})},drag:function(t,e,i){for(var s,n,o,a,r,l,h,c,u,d=i.options,p=d.snapTolerance,f=e.offset.left,g=f+i.helperProportions.width,m=e.offset.top,_=m+i.helperProportions.height,v=i.snapElements.length-1;0<=v;v--)l=(r=i.snapElements[v].left-i.margins.left)+i.snapElements[v].width,c=(h=i.snapElements[v].top-i.margins.top)+i.snapElements[v].height,g<r-p||l+p<f||_<h-p||c+p<m||!V.contains(i.snapElements[v].item.ownerDocument,i.snapElements[v].item)?(i.snapElements[v].snapping&&i.options.snap.release&&i.options.snap.release.call(i.element,t,V.extend(i._uiHash(),{snapItem:i.snapElements[v].item})),i.snapElements[v].snapping=!1):("inner"!==d.snapMode&&(s=Math.abs(h-_)<=p,n=Math.abs(c-m)<=p,o=Math.abs(r-g)<=p,a=Math.abs(l-f)<=p,s&&(e.position.top=i._convertPositionTo("relative",{top:h-i.helperProportions.height,left:0}).top),n&&(e.position.top=i._convertPositionTo("relative",{top:c,left:0}).top),o&&(e.position.left=i._convertPositionTo("relative",{top:0,left:r-i.helperProportions.width}).left),a)&&(e.position.left=i._convertPositionTo("relative",{top:0,left:l}).left),u=s||n||o||a,"outer"!==d.snapMode&&(s=Math.abs(h-m)<=p,n=Math.abs(c-_)<=p,o=Math.abs(r-f)<=p,a=Math.abs(l-g)<=p,s&&(e.position.top=i._convertPositionTo("relative",{top:h,left:0}).top),n&&(e.position.top=i._convertPositionTo("relative",{top:c-i.helperProportions.height,left:0}).top),o&&(e.position.left=i._convertPositionTo("relative",{top:0,left:r}).left),a)&&(e.position.left=i._convertPositionTo("relative",{top:0,left:l-i.helperProportions.width}).left),!i.snapElements[v].snapping&&(s||n||o||a||u)&&i.options.snap.snap&&i.options.snap.snap.call(i.element,t,V.extend(i._uiHash(),{snapItem:i.snapElements[v].item})),i.snapElements[v].snapping=s||n||o||a||u)}}),V.ui.plugin.add("draggable","stack",{start:function(t,e,i){var s,i=i.options,i=V.makeArray(V(i.stack)).sort(function(t,e){return(parseInt(V(t).css("zIndex"),10)||0)-(parseInt(V(e).css("zIndex"),10)||0)});i.length&&(s=parseInt(V(i[0]).css("zIndex"),10)||0,V(i).each(function(t){V(this).css("zIndex",s+t)}),this.css("zIndex",s+i.length))}}),V.ui.plugin.add("draggable","zIndex",{start:function(t,e,i){e=V(e.helper),i=i.options;e.css("zIndex")&&(i._zIndex=e.css("zIndex")),e.css("zIndex",i.zIndex)},stop:function(t,e,i){i=i.options;i._zIndex&&V(e.helper).css("zIndex",i._zIndex)}}),V.ui.draggable,V.widget("ui.resizable",V.ui.mouse,{version:"1.14.1",widgetEventPrefix:"resize",options:{alsoResize:!1,animate:!1,animateDuration:"slow",animateEasing:"swing",aspectRatio:!1,autoHide:!1,classes:{"ui-resizable-se":"ui-icon ui-icon-gripsmall-diagonal-se"},containment:!1,ghost:!1,grid:!1,handles:"e,s,se",helper:!1,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:90,resize:null,start:null,stop:null},_num:function(t){return parseFloat(t)||0},_isNumber:function(t){return!isNaN(parseFloat(t))},_hasScroll:function(t,e){var i=!1,s=V(t).css("overflow");if("hidden"===s)return!1;if("scroll"===s)return!0;if(0<t[s=e&&"left"===e?"scrollLeft":"scrollTop"])return!0;try{t[s]=1,i=0<t[s],t[s]=0}catch(t){}return i},_create:function(){var t,e=this.options,i=this;this._addClass("ui-resizable"),V.extend(this,{_aspectRatio:!!e.aspectRatio,aspectRatio:e.aspectRatio,originalElement:this.element,_proportionallyResizeElements:[],_helper:e.helper||e.ghost||e.animate?e.helper||"ui-resizable-helper":null}),this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i)&&(this.element.wrap(V("<div class='ui-wrapper'></div>").css({overflow:"hidden",position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),top:this.element.css("top"),left:this.element.css("left")})),this.element=this.element.parent().data("ui-resizable",this.element.resizable("instance")),this.elementIsWrapper=!0,t={marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom"),marginLeft:this.originalElement.css("marginLeft")},this.element.css(t),this.originalResizeStyle=this.originalElement.css("resize"),this.originalElement.css("resize","none"),this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"})),this._proportionallyResize()),this._setupHandles(),e.autoHide&&V(this.element).on("mouseenter",function(){e.disabled||(i._removeClass("ui-resizable-autohide"),i._handles.show())}).on("mouseleave",function(){e.disabled||i.resizing||(i._addClass("ui-resizable-autohide"),i._handles.hide())}),this._mouseInit()},_destroy:function(){this._mouseDestroy(),this._addedHandles.remove();function t(t){V(t).removeData("resizable").removeData("ui-resizable").off(".resizable")}var e;return this.elementIsWrapper&&(t(this.element),e=this.element,this.originalElement.css({position:e.css("position"),width:e.outerWidth(),height:e.outerHeight(),top:e.css("top"),left:e.css("left")}).insertAfter(e),e.remove()),this.originalElement.css("resize",this.originalResizeStyle),t(this.originalElement),this},_setOption:function(t,e){switch(this._super(t,e),t){case"handles":this._removeHandles(),this._setupHandles();break;case"aspectRatio":this._aspectRatio=!!e}},_setupHandles:function(){var t,e,i,s,n,o=this.options,a=this;if(this.handles=o.handles||(V(".ui-resizable-handle",this.element).length?{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",nw:".ui-resizable-nw"}:"e,s,se"),this._handles=V(),this._addedHandles=V(),this.handles.constructor===String)for("all"===this.handles&&(this.handles="n,e,s,w,se,sw,ne,nw"),i=this.handles.split(","),this.handles={},e=0;e<i.length;e++)s="ui-resizable-"+(t=String.prototype.trim.call(i[e])),n=V("<div>"),this._addClass(n,"ui-resizable-handle "+s),n.css({zIndex:o.zIndex}),this.handles[t]=".ui-resizable-"+t,this.element.children(this.handles[t]).length||(this.element.append(n),this._addedHandles=this._addedHandles.add(n));this._renderAxis=function(t){var e,i,s;for(e in t=t||this.element,this.handles)this.handles[e].constructor===String?this.handles[e]=this.element.children(this.handles[e]).first().show():(this.handles[e].jquery||this.handles[e].nodeType)&&(this.handles[e]=V(this.handles[e]),this._on(this.handles[e],{mousedown:a._mouseDown})),this.elementIsWrapper&&this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i)&&(s=V(this.handles[e],this.element),s=/sw|ne|nw|se|n|s/.test(e)?s.outerHeight():s.outerWidth(),i=["padding",/ne|nw|n/.test(e)?"Top":/se|sw|s/.test(e)?"Bottom":/^e$/.test(e)?"Right":"Left"].join(""),t.css(i,s),this._proportionallyResize()),this._handles=this._handles.add(this.handles[e])},this._renderAxis(this.element),this._handles=this._handles.add(this.element.find(".ui-resizable-handle")),this._handles.disableSelection(),this._handles.on("mouseover",function(){a.resizing||(this.className&&(n=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)),a.axis=n&&n[1]?n[1]:"se")}),o.autoHide&&(this._handles.hide(),this._addClass("ui-resizable-autohide"))},_removeHandles:function(){this._addedHandles.remove()},_mouseCapture:function(t){var e,i,s=!1;for(e in this.handles)(i=V(this.handles[e])[0])!==t.target&&!V.contains(i,t.target)||(s=!0);return!this.options.disabled&&s},_mouseStart:function(t){var e,i,s,n=this.options,o=this.element;return this.resizing=!0,this._renderProxy(),e=this._num(this.helper.css("left")),i=this._num(this.helper.css("top")),n.containment&&(e+=V(n.containment).scrollLeft()||0,i+=V(n.containment).scrollTop()||0),this.offset=this.helper.offset(),this.position={left:e,top:i},this._helper||(s=this._calculateAdjustedElementDimensions(o)),this.size=this._helper?{width:this.helper.width(),height:this.helper.height()}:{width:s.width,height:s.height},this.originalSize=this._helper?{width:o.outerWidth(),height:o.outerHeight()}:{width:s.width,height:s.height},this.sizeDiff={width:o.outerWidth()-o.width(),height:o.outerHeight()-o.height()},this.originalPosition={left:e,top:i},this.originalMousePosition={left:t.pageX,top:t.pageY},this.aspectRatio="number"==typeof n.aspectRatio?n.aspectRatio:this.originalSize.width/this.originalSize.height||1,s=V(".ui-resizable-"+this.axis).css("cursor"),V("body").css("cursor","auto"===s?this.axis+"-resize":s),this._addClass("ui-resizable-resizing"),this._propagate("start",t),!0},_mouseDrag:function(t){var e=this.originalMousePosition,i=this.axis,s=t.pageX-e.left||0,e=t.pageY-e.top||0,i=this._change[i];return this._updatePrevProperties(),i&&(i=i.apply(this,[t,s,e]),this._updateVirtualBoundaries(t.shiftKey),(this._aspectRatio||t.shiftKey)&&(i=this._updateRatio(i,t)),i=this._respectSize(i,t),this._updateCache(i),this._propagate("resize",t),s=this._applyChanges(),!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize(),V.isEmptyObject(s)||(this._updatePrevProperties(),this._trigger("resize",t,this.ui()),this._applyChanges())),!1},_mouseStop:function(t){this.resizing=!1;var e,i,s,n=this.options,o=this;return this._helper&&(i=(e=(i=this._proportionallyResizeElements).length&&/textarea/i.test(i[0].nodeName))&&this._hasScroll(i[0],"left")?0:o.sizeDiff.height,e=e?0:o.sizeDiff.width,e={width:o.helper.width()-e,height:o.helper.height()-i},i=parseFloat(o.element.css("left"))+(o.position.left-o.originalPosition.left)||null,s=parseFloat(o.element.css("top"))+(o.position.top-o.originalPosition.top)||null,n.animate||this.element.css(V.extend(e,{top:s,left:i})),o.helper.height(o.size.height),o.helper.width(o.size.width),this._helper)&&!n.animate&&this._proportionallyResize(),V("body").css("cursor","auto"),this._removeClass("ui-resizable-resizing"),this._propagate("stop",t),this._helper&&this.helper.remove(),!1},_updatePrevProperties:function(){this.prevPosition={top:this.position.top,left:this.position.left},this.prevSize={width:this.size.width,height:this.size.height}},_applyChanges:function(){var t={};return this.position.top!==this.prevPosition.top&&(t.top=this.position.top+"px"),this.position.left!==this.prevPosition.left&&(t.left=this.position.left+"px"),this.helper.css(t),this.size.width!==this.prevSize.width&&(t.width=this.size.width+"px",this.helper.width(t.width)),this.size.height!==this.prevSize.height&&(t.height=this.size.height+"px",this.helper.height(t.height)),t},_updateVirtualBoundaries:function(t){var e,i,s,n=this.options,n={minWidth:this._isNumber(n.minWidth)?n.minWidth:0,maxWidth:this._isNumber(n.maxWidth)?n.maxWidth:1/0,minHeight:this._isNumber(n.minHeight)?n.minHeight:0,maxHeight:this._isNumber(n.maxHeight)?n.maxHeight:1/0};(this._aspectRatio||t)&&(t=n.minHeight*this.aspectRatio,i=n.minWidth/this.aspectRatio,e=n.maxHeight*this.aspectRatio,s=n.maxWidth/this.aspectRatio,n.minWidth<t&&(n.minWidth=t),n.minHeight<i&&(n.minHeight=i),e<n.maxWidth&&(n.maxWidth=e),s<n.maxHeight)&&(n.maxHeight=s),this._vBoundaries=n},_updateCache:function(t){this.offset=this.helper.offset(),this._isNumber(t.left)&&(this.position.left=t.left),this._isNumber(t.top)&&(this.position.top=t.top),this._isNumber(t.height)&&(this.size.height=t.height),this._isNumber(t.width)&&(this.size.width=t.width)},_updateRatio:function(t){var e=this.position,i=this.size,s=this.axis;return this._isNumber(t.height)?t.width=t.height*this.aspectRatio:this._isNumber(t.width)&&(t.height=t.width/this.aspectRatio),"sw"===s&&(t.left=e.left+(i.width-t.width),t.top=null),"nw"===s&&(t.top=e.top+(i.height-t.height),t.left=e.left+(i.width-t.width)),t},_respectSize:function(t){var e=this._vBoundaries,i=this.axis,s=this._isNumber(t.width)&&e.maxWidth&&e.maxWidth<t.width,n=this._isNumber(t.height)&&e.maxHeight&&e.maxHeight<t.height,o=this._isNumber(t.width)&&e.minWidth&&e.minWidth>t.width,a=this._isNumber(t.height)&&e.minHeight&&e.minHeight>t.height,r=this.originalPosition.left+this.originalSize.width,l=this.originalPosition.top+this.originalSize.height,h=/sw|nw|w/.test(i),i=/nw|ne|n/.test(i);return o&&(t.width=e.minWidth),a&&(t.height=e.minHeight),s&&(t.width=e.maxWidth),n&&(t.height=e.maxHeight),o&&h&&(t.left=r-e.minWidth),s&&h&&(t.left=r-e.maxWidth),a&&i&&(t.top=l-e.minHeight),n&&i&&(t.top=l-e.maxHeight),t.width||t.height||t.left||!t.top?t.width||t.height||t.top||!t.left||(t.left=null):t.top=null,t},_getPaddingPlusBorderDimensions:function(t){for(var e=0,i=[],s=[t.css("borderTopWidth"),t.css("borderRightWidth"),t.css("borderBottomWidth"),t.css("borderLeftWidth")],n=[t.css("paddingTop"),t.css("paddingRight"),t.css("paddingBottom"),t.css("paddingLeft")];e<4;e++)i[e]=parseFloat(s[e])||0,i[e]+=parseFloat(n[e])||0;return{height:i[0]+i[2],width:i[1]+i[3]}},_calculateAdjustedElementDimensions:function(t){var e,i,s=t.get(0);return"content-box"!==t.css("box-sizing")||!this._hasScroll(s)&&!this._hasScroll(s,"left")?{height:parseFloat(t.css("height")),width:parseFloat(t.css("width"))}:(e=parseFloat(s.style.width),s=parseFloat(s.style.height),i=this._getPaddingPlusBorderDimensions(t),e=isNaN(e)?this._getElementTheoreticalSize(t,i,"width"):e,{height:isNaN(s)?this._getElementTheoreticalSize(t,i,"height"):s,width:e})},_getElementTheoreticalSize:function(t,e,i){return Math.max(0,Math.ceil(t.get(0)["offset"+i[0].toUpperCase()+i.slice(1)]-e[i]-.5))||0},_proportionallyResize:function(){if(this._proportionallyResizeElements.length)for(var t,e=0,i=this.helper||this.element;e<this._proportionallyResizeElements.length;e++)t=this._proportionallyResizeElements[e],this.outerDimensions||(this.outerDimensions=this._getPaddingPlusBorderDimensions(t)),t.css({height:i.height()-this.outerDimensions.height||0,width:i.width()-this.outerDimensions.width||0})},_renderProxy:function(){var t=this.element,e=this.options;this.elementOffset=t.offset(),this._helper?(this.helper=this.helper||V("<div></div>").css({overflow:"hidden"}),this._addClass(this.helper,this._helper),this.helper.css({width:this.element.outerWidth(),height:this.element.outerHeight(),position:"absolute",left:this.elementOffset.left+"px",top:this.elementOffset.top+"px",zIndex:++e.zIndex}),this.helper.appendTo("body").disableSelection()):this.helper=this.element},_change:{e:function(t,e){return{width:this.originalSize.width+e}},w:function(t,e){var i=this.originalSize;return{left:this.originalPosition.left+e,width:i.width-e}},n:function(t,e,i){var s=this.originalSize;return{top:this.originalPosition.top+i,height:s.height-i}},s:function(t,e,i){return{height:this.originalSize.height+i}},se:function(t,e,i){return V.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[t,e,i]))},sw:function(t,e,i){return V.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[t,e,i]))},ne:function(t,e,i){return V.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[t,e,i]))},nw:function(t,e,i){return V.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[t,e,i]))}},_propagate:function(t,e){V.ui.plugin.call(this,t,[e,this.ui()]),"resize"!==t&&this._trigger(t,e,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}}),V.ui.plugin.add("resizable","animate",{stop:function(e){var i=V(this).resizable("instance"),t=i.options,s=i._proportionallyResizeElements,n=s.length&&/textarea/i.test(s[0].nodeName),o=n&&i._hasScroll(s[0],"left")?0:i.sizeDiff.height,n=n?0:i.sizeDiff.width,n={width:i.size.width-n,height:i.size.height-o},o=parseFloat(i.element.css("left"))+(i.position.left-i.originalPosition.left)||null,a=parseFloat(i.element.css("top"))+(i.position.top-i.originalPosition.top)||null;i.element.animate(V.extend(n,a&&o?{top:a,left:o}:{}),{duration:t.animateDuration,easing:t.animateEasing,step:function(){var t={width:parseFloat(i.element.css("width")),height:parseFloat(i.element.css("height")),top:parseFloat(i.element.css("top")),left:parseFloat(i.element.css("left"))};s&&s.length&&V(s[0]).css({width:t.width,height:t.height}),i._updateCache(t),i._propagate("resize",e)}})}}),V.ui.plugin.add("resizable","containment",{start:function(){var i,s,t,e,n=V(this).resizable("instance"),o=n.options,a=n.element,o=o.containment,a=o instanceof V?o.get(0):/parent/.test(o)?a.parent().get(0):o;a&&(n.containerElement=V(a),/document/.test(o)||o===document?(n.containerOffset={left:0,top:0},n.containerPosition={left:0,top:0},n.parentData={element:V(document),left:0,top:0,width:V(document).width(),height:V(document).height()||document.body.parentNode.scrollHeight}):(i=V(a),s=[],V(["Top","Right","Left","Bottom"]).each(function(t,e){s[t]=n._num(i.css("padding"+e))}),n.containerOffset=i.offset(),n.containerPosition=i.position(),n.containerSize={height:i.innerHeight()-s[3],width:i.innerWidth()-s[1]},o=n.containerOffset,e=n.containerSize.height,t=n.containerSize.width,t=n._hasScroll(a,"left")?a.scrollWidth:t,e=n._hasScroll(a)?a.scrollHeight:e,n.parentData={element:a,left:o.left,top:o.top,width:t,height:e}))},resize:function(t){var e=V(this).resizable("instance"),i=e.options,s=e.containerOffset,n=e.position,t=e._aspectRatio||t.shiftKey,o={top:0,left:0},a=e.containerElement,r=!0;a[0]!==document&&/static/.test(a.css("position"))&&(o=s),n.left<(e._helper?s.left:0)&&(e.size.width=e.size.width+(e._helper?e.position.left-s.left:e.position.left-o.left),t&&(e.size.height=e.size.width/e.aspectRatio,r=!1),e.position.left=i.helper?s.left:0),n.top<(e._helper?s.top:0)&&(e.size.height=e.size.height+(e._helper?e.position.top-s.top:e.position.top),t&&(e.size.width=e.size.height*e.aspectRatio,r=!1),e.position.top=e._helper?s.top:0),a=e.containerElement.get(0)===e.element.parent().get(0),i=/relative|absolute/.test(e.containerElement.css("position")),a&&i?(e.offset.left=e.parentData.left+e.position.left,e.offset.top=e.parentData.top+e.position.top):(e.offset.left=e.element.offset().left,e.offset.top=e.element.offset().top),n=Math.abs(e.sizeDiff.width+(e._helper?e.offset.left-o.left:e.offset.left-s.left)),a=Math.abs(e.sizeDiff.height+(e._helper?e.offset.top-o.top:e.offset.top-s.top)),n+e.size.width>=e.parentData.width&&(e.size.width=e.parentData.width-n,t)&&(e.size.height=e.size.width/e.aspectRatio,r=!1),a+e.size.height>=e.parentData.height&&(e.size.height=e.parentData.height-a,t)&&(e.size.width=e.size.height*e.aspectRatio,r=!1),r||(e.position.left=e.prevPosition.left,e.position.top=e.prevPosition.top,e.size.width=e.prevSize.width,e.size.height=e.prevSize.height)},stop:function(){var t=V(this).resizable("instance"),e=t.options,i=t.containerOffset,s=t.containerPosition,n=t.containerElement,o=V(t.helper),a=o.offset(),r=o.outerWidth()-t.sizeDiff.width,o=o.outerHeight()-t.sizeDiff.height;t._helper&&!e.animate&&/relative/.test(n.css("position"))&&V(this).css({left:a.left-s.left-i.left,width:r,height:o}),t._helper&&!e.animate&&/static/.test(n.css("position"))&&V(this).css({left:a.left-s.left-i.left,width:r,height:o})}}),V.ui.plugin.add("resizable","alsoResize",{start:function(){var i=V(this).resizable("instance"),t=i.options;V(t.alsoResize).each(function(){var t=V(this),e=i._calculateAdjustedElementDimensions(t);t.data("ui-resizable-alsoresize",{width:e.width,height:e.height,left:parseFloat(t.css("left")),top:parseFloat(t.css("top"))})})},resize:function(t,i){var e=V(this).resizable("instance"),s=e.options,n=e.originalSize,o=e.originalPosition,a={height:e.size.height-n.height||0,width:e.size.width-n.width||0,top:e.position.top-o.top||0,left:e.position.left-o.left||0};V(s.alsoResize).each(function(){var t=V(this),s=V(this).data("ui-resizable-alsoresize"),n={},e=t.parents(i.originalElement[0]).length?["width","height"]:["width","height","top","left"];V.each(e,function(t,e){var i=(s[e]||0)+(a[e]||0);i&&0<=i&&(n[e]=i||null)}),t.css(n)})},stop:function(){V(this).removeData("ui-resizable-alsoresize")}}),V.ui.plugin.add("resizable","ghost",{start:function(){var t=V(this).resizable("instance"),e=t.size;t.ghost=t.originalElement.clone(),t.ghost.css({opacity:.25,display:"block",position:"relative",height:e.height,width:e.width,margin:0,left:0,top:0}),t._addClass(t.ghost,"ui-resizable-ghost"),!0===V.uiBackCompat&&"string"==typeof t.options.ghost&&t.ghost.addClass(this.options.ghost),t.ghost.appendTo(t.helper)},resize:function(){var t=V(this).resizable("instance");t.ghost&&t.ghost.css({position:"relative",height:t.size.height,width:t.size.width})},stop:function(){var t=V(this).resizable("instance");t.ghost&&t.helper&&t.helper.get(0).removeChild(t.ghost.get(0))}}),V.ui.plugin.add("resizable","grid",{resize:function(){var t,e=V(this).resizable("instance"),i=e.options,s=e.size,n=e.originalSize,o=e.originalPosition,a=e.axis,r="number"==typeof i.grid?[i.grid,i.grid]:i.grid,l=r[0]||1,h=r[1]||1,c=Math.round((s.width-n.width)/l)*l,s=Math.round((s.height-n.height)/h)*h,u=n.width+c,d=n.height+s,p=i.maxWidth&&i.maxWidth<u,f=i.maxHeight&&i.maxHeight<d,g=i.minWidth&&i.minWidth>u,m=i.minHeight&&i.minHeight>d;i.grid=r,g&&(u+=l),m&&(d+=h),p&&(u-=l),f&&(d-=h),/^(se|s|e)$/.test(a)?(e.size.width=u,e.size.height=d):/^(ne)$/.test(a)?(e.size.width=u,e.size.height=d,e.position.top=o.top-s):/^(sw)$/.test(a)?(e.size.width=u,e.size.height=d,e.position.left=o.left-c):((d-h<=0||u-l<=0)&&(t=e._getPaddingPlusBorderDimensions(this)),0<d-h?(e.size.height=d,e.position.top=o.top-s):(d=h-t.height,e.size.height=d,e.position.top=o.top+n.height-d),0<u-l?(e.size.width=u,e.position.left=o.left-c):(u=l-t.width,e.size.width=u,e.position.left=o.left+n.width-u))}}),V.ui.resizable,V.widget("ui.dialog",{version:"1.14.1",options:{appendTo:"body",autoOpen:!0,buttons:[],classes:{"ui-dialog":"ui-corner-all","ui-dialog-titlebar":"ui-corner-all"},closeOnEscape:!0,closeText:"Close",draggable:!0,hide:null,height:"auto",maxHeight:null,maxWidth:null,minHeight:150,minWidth:150,modal:!1,position:{my:"center",at:"center",of:window,collision:"fit",using:function(t){var e=V(this).css(t).offset().top;e<0&&V(this).css("top",t.top-e)}},resizable:!0,show:null,title:null,uiDialogTitleHeadingLevel:0,width:300,beforeClose:null,close:null,drag:null,dragStart:null,dragStop:null,focus:null,open:null,resize:null,resizeStart:null,resizeStop:null},sizeRelatedOptions:{buttons:!0,height:!0,maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0,width:!0},resizableRelatedOptions:{maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0},_create:function(){this.originalCss={display:this.element[0].style.display,width:this.element[0].style.width,minHeight:this.element[0].style.minHeight,maxHeight:this.element[0].style.maxHeight,height:this.element[0].style.height},this.originalPosition={parent:this.element.parent(),index:this.element.parent().children().index(this.element)},this.originalTitle=this.element.attr("title"),null==this.options.title&&null!=this.originalTitle&&(this.options.title=this.originalTitle),this.options.disabled&&(this.options.disabled=!1),this._createWrapper(),this.element.show().removeAttr("title").appendTo(this.uiDialog),this._addClass("ui-dialog-content","ui-widget-content"),this._createTitlebar(),this._createButtonPane(),this.options.draggable&&V.fn.draggable&&this._makeDraggable(),this.options.resizable&&V.fn.resizable&&this._makeResizable(),this._isOpen=!1,this._trackFocus()},_init:function(){this.options.autoOpen&&this.open()},_appendTo:function(){var t=this.options.appendTo;return t&&(t.jquery||t.nodeType)?V(t):this.document.find(t||"body").eq(0)},_destroy:function(){var t,e=this.originalPosition;this._untrackInstance(),this._destroyOverlay(),this.element.removeUniqueId().css(this.originalCss).detach(),this.uiDialog.remove(),this.originalTitle&&this.element.attr("title",this.originalTitle),(t=e.parent.children().eq(e.index)).length&&t[0]!==this.element[0]?t.before(this.element):e.parent.append(this.element)},widget:function(){return this.uiDialog},disable:V.noop,enable:V.noop,close:function(t){var e=this;this._isOpen&&!1!==this._trigger("beforeClose",t)&&(this._isOpen=!1,this._focusedElement=null,this._destroyOverlay(),this._untrackInstance(),this.opener.filter(":focusable").trigger("focus").length||V(this.document[0].activeElement).trigger("blur"),this._hide(this.uiDialog,this.options.hide,function(){e._trigger("close",t)}))},isOpen:function(){return this._isOpen},moveToTop:function(){this._moveToTop()},_moveToTop:function(t,e){var i=!1,s=this.uiDialog.siblings(".ui-front:visible").map(function(){return+V(this).css("z-index")}).get(),s=Math.max.apply(null,s);return s>=+this.uiDialog.css("z-index")&&(this.uiDialog.css("z-index",s+1),i=!0),i&&!e&&this._trigger("focus",t),i},open:function(){var t=this;this._isOpen?this._moveToTop()&&this._focusTabbable():(this._isOpen=!0,this.opener=V(this.document[0].activeElement),this._size(),this._position(),this._createOverlay(),this._moveToTop(null,!0),this.overlay&&this.overlay.css("z-index",this.uiDialog.css("z-index")-1),this._show(this.uiDialog,this.options.show,function(){t._focusTabbable(),t._trigger("focus")}),this._makeFocusTarget(),this._trigger("open"))},_focusTabbable:function(){var t=this._focusedElement;(t=(t=(t=(t=(t=t||this.element.find("[autofocus]")).length?t:this.element.find(":tabbable")).length?t:this.uiDialogButtonPane.find(":tabbable")).length?t:this.uiDialogTitlebarClose.filter(":tabbable")).length?t:this.uiDialog).eq(0).trigger("focus")},_restoreTabbableFocus:function(){var t=this.document[0].activeElement;this.uiDialog[0]===t||V.contains(this.uiDialog[0],t)||this._focusTabbable()},_keepFocus:function(t){t.preventDefault(),this._restoreTabbableFocus()},_createWrapper:function(){this.uiDialog=V("<div>").hide().attr({tabIndex:-1,role:"dialog","aria-modal":this.options.modal?"true":null}).appendTo(this._appendTo()),this._addClass(this.uiDialog,"ui-dialog","ui-widget ui-widget-content ui-front"),this._on(this.uiDialog,{keydown:function(t){var e,i,s;this.options.closeOnEscape&&!t.isDefaultPrevented()&&t.keyCode&&t.keyCode===V.ui.keyCode.ESCAPE?(t.preventDefault(),this.close(t)):t.keyCode!==V.ui.keyCode.TAB||t.isDefaultPrevented()||(e=this.uiDialog.find(":tabbable"),i=e.first(),s=e.last(),t.target!==s[0]&&t.target!==this.uiDialog[0]||t.shiftKey?t.target!==i[0]&&t.target!==this.uiDialog[0]||!t.shiftKey||(this._delay(function(){s.trigger("focus")}),t.preventDefault()):(this._delay(function(){i.trigger("focus")}),t.preventDefault()))},mousedown:function(t){this._moveToTop(t)&&this._focusTabbable()}}),this.element.find("[aria-describedby]").length||this.uiDialog.attr({"aria-describedby":this.element.uniqueId().attr("id")})},_createTitlebar:function(){this.uiDialogTitlebar=V("<div>"),this._addClass(this.uiDialogTitlebar,"ui-dialog-titlebar","ui-widget-header ui-helper-clearfix"),this._on(this.uiDialogTitlebar,{mousedown:function(t){V(t.target).closest(".ui-dialog-titlebar-close")||this.uiDialog.trigger("focus")}}),this.uiDialogTitlebarClose=V("<button type='button'></button>").button({label:V("<a>").text(this.options.closeText).html(),icon:"ui-icon-closethick",showLabel:!1}).appendTo(this.uiDialogTitlebar),this._addClass(this.uiDialogTitlebarClose,"ui-dialog-titlebar-close"),this._on(this.uiDialogTitlebarClose,{click:function(t){t.preventDefault(),this.close(t)}});var t=Number.isInteger(this.options.uiDialogTitleHeadingLevel)&&0<this.options.uiDialogTitleHeadingLevel&&this.options.uiDialogTitleHeadingLevel<=6?"h"+this.options.uiDialogTitleHeadingLevel:"span",t=V("<"+t+">").uniqueId().prependTo(this.uiDialogTitlebar);this._addClass(t,"ui-dialog-title"),this._title(t),this.uiDialogTitlebar.prependTo(this.uiDialog),this.uiDialog.attr({"aria-labelledby":t.attr("id")})},_title:function(t){this.options.title?t.text(this.options.title):t.html("&#160;")},_createButtonPane:function(){this.uiDialogButtonPane=V("<div>"),this._addClass(this.uiDialogButtonPane,"ui-dialog-buttonpane","ui-widget-content ui-helper-clearfix"),this.uiButtonSet=V("<div>").appendTo(this.uiDialogButtonPane),this._addClass(this.uiButtonSet,"ui-dialog-buttonset"),this._createButtons()},_createButtons:function(){var s=this,t=this.options.buttons;this.uiDialogButtonPane.remove(),this.uiButtonSet.empty(),V.isEmptyObject(t)||Array.isArray(t)&&!t.length?this._removeClass(this.uiDialog,"ui-dialog-buttons"):(V.each(t,function(t,e){var i;e=V.extend({type:"button"},e="function"==typeof e?{click:e,text:t}:e),i=e.click,t={icon:e.icon,iconPosition:e.iconPosition,showLabel:e.showLabel,icons:e.icons,text:e.text},delete e.click,delete e.icon,delete e.iconPosition,delete e.showLabel,delete e.icons,"boolean"==typeof e.text&&delete e.text,V("<button></button>",e).button(t).appendTo(s.uiButtonSet).on("click",function(){i.apply(s.element[0],arguments)})}),this._addClass(this.uiDialog,"ui-dialog-buttons"),this.uiDialogButtonPane.appendTo(this.uiDialog))},_makeDraggable:function(){var n=this,o=this.options;function a(t){return{position:t.position,offset:t.offset}}this.uiDialog.draggable({cancel:".ui-dialog-content, .ui-dialog-titlebar-close",handle:".ui-dialog-titlebar",containment:"document",start:function(t,e){n._addClass(V(this),"ui-dialog-dragging"),n._blockFrames(),n._trigger("dragStart",t,a(e))},drag:function(t,e){n._trigger("drag",t,a(e))},stop:function(t,e){var i=e.offset.left-n.document.scrollLeft(),s=e.offset.top-n.document.scrollTop();o.position={my:"left top",at:"left"+(0<=i?"+":"")+i+" top"+(0<=s?"+":"")+s,of:n.window},n._removeClass(V(this),"ui-dialog-dragging"),n._unblockFrames(),n._trigger("dragStop",t,a(e))}})},_makeResizable:function(){var n=this,o=this.options,t=o.resizable,e=this.uiDialog.css("position"),t="string"==typeof t?t:"n,e,s,w,se,sw,ne,nw";function a(t){return{originalPosition:t.originalPosition,originalSize:t.originalSize,position:t.position,size:t.size}}this.uiDialog.resizable({cancel:".ui-dialog-content",containment:"document",alsoResize:this.element,maxWidth:o.maxWidth,maxHeight:o.maxHeight,minWidth:o.minWidth,minHeight:this._minHeight(),handles:t,start:function(t,e){n._addClass(V(this),"ui-dialog-resizing"),n._blockFrames(),n._trigger("resizeStart",t,a(e))},resize:function(t,e){n._trigger("resize",t,a(e))},stop:function(t,e){var i=n.uiDialog.offset(),s=i.left-n.document.scrollLeft(),i=i.top-n.document.scrollTop();o.height=n.uiDialog.height(),o.width=n.uiDialog.width(),o.position={my:"left top",at:"left"+(0<=s?"+":"")+s+" top"+(0<=i?"+":"")+i,of:n.window},n._removeClass(V(this),"ui-dialog-resizing"),n._unblockFrames(),n._trigger("resizeStop",t,a(e))}}).css("position",e)},_trackFocus:function(){this._on(this.widget(),{focusin:function(t){this._makeFocusTarget(),this._focusedElement=V(t.target)}})},_makeFocusTarget:function(){this._untrackInstance(),this._trackingInstances().unshift(this)},_untrackInstance:function(){var t=this._trackingInstances(),e=V.inArray(this,t);-1!==e&&t.splice(e,1)},_trackingInstances:function(){var t=this.document.data("ui-dialog-instances");return t||this.document.data("ui-dialog-instances",t=[]),t},_minHeight:function(){var t=this.options;return"auto"===t.height?t.minHeight:Math.min(t.minHeight,t.height)},_position:function(){var t=this.uiDialog.is(":visible");t||this.uiDialog.show(),this.uiDialog.position(this.options.position),t||this.uiDialog.hide()},_setOptions:function(t){var i=this,s=!1,n={};V.each(t,function(t,e){i._setOption(t,e),t in i.sizeRelatedOptions&&(s=!0),t in i.resizableRelatedOptions&&(n[t]=e)}),s&&(this._size(),this._position()),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option",n)},_setOption:function(t,e){var i,s=this.uiDialog;"disabled"!==t&&(this._super(t,e),"appendTo"===t&&this.uiDialog.appendTo(this._appendTo()),"buttons"===t&&this._createButtons(),"closeText"===t&&this.uiDialogTitlebarClose.button({label:V("<a>").text(""+this.options.closeText).html()}),"draggable"===t&&((i=s.is(":data(ui-draggable)"))&&!e&&s.draggable("destroy"),!i)&&e&&this._makeDraggable(),"position"===t&&this._position(),"resizable"===t&&((i=s.is(":data(ui-resizable)"))&&!e&&s.resizable("destroy"),i&&"string"==typeof e&&s.resizable("option","handles",e),i||!1===e||this._makeResizable()),"title"===t&&this._title(this.uiDialogTitlebar.find(".ui-dialog-title")),"modal"===t)&&s.attr("aria-modal",e?"true":null)},_size:function(){var t,e,i,s=this.options;this.element.show().css({width:"auto",minHeight:0,maxHeight:"none",height:0}),s.minWidth>s.width&&(s.width=s.minWidth),t=this.uiDialog.css({height:"auto",width:s.width}).outerHeight(),e=Math.max(0,s.minHeight-t),i="number"==typeof s.maxHeight?Math.max(0,s.maxHeight-t):"none","auto"===s.height?this.element.css({minHeight:e,maxHeight:i,height:"auto"}):this.element.height(Math.max(0,s.height-t)),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option","minHeight",this._minHeight())},_blockFrames:function(){this.iframeBlocks=this.document.find("iframe").map(function(){var t=V(this);return V("<div>").css({position:"absolute",width:t.outerWidth(),height:t.outerHeight()}).appendTo(t.parent()).offset(t.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_allowInteraction:function(t){return!!V(t.target).closest(".ui-dialog").length||!!V(t.target).closest(".ui-datepicker").length},_createOverlay:function(){var i;this.options.modal&&(i=!0,this._delay(function(){i=!1}),this.document.data("ui-dialog-overlays")||this.document.on("focusin.ui-dialog",function(t){var e;i||(e=this._trackingInstances()[0])._allowInteraction(t)||(t.preventDefault(),e._focusTabbable())}.bind(this)),this.overlay=V("<div>").appendTo(this._appendTo()),this._addClass(this.overlay,null,"ui-widget-overlay ui-front"),this._on(this.overlay,{mousedown:"_keepFocus"}),this.document.data("ui-dialog-overlays",(this.document.data("ui-dialog-overlays")||0)+1))},_destroyOverlay:function(){var t;this.options.modal&&this.overlay&&((t=this.document.data("ui-dialog-overlays")-1)?this.document.data("ui-dialog-overlays",t):(this.document.off("focusin.ui-dialog"),this.document.removeData("ui-dialog-overlays")),this.overlay.remove(),this.overlay=null)}}),!0===V.uiBackCompat&&V.widget("ui.dialog",V.ui.dialog,{options:{dialogClass:""},_createWrapper:function(){this._super(),this.uiDialog.addClass(this.options.dialogClass)},_setOption:function(t,e){"dialogClass"===t&&this.uiDialog.removeClass(this.options.dialogClass).addClass(e),this._superApply(arguments)}}),V.ui.dialog;function rt(t,e,i){return e<=t&&t<e+i}V.widget("ui.droppable",{version:"1.14.1",widgetEventPrefix:"drop",options:{accept:"*",addClasses:!0,greedy:!1,scope:"default",tolerance:"intersect",activate:null,deactivate:null,drop:null,out:null,over:null},_create:function(){var t,e=this.options,i=e.accept;this.isover=!1,this.isout=!0,this.accept="function"==typeof i?i:function(t){return t.is(i)},this.proportions=function(){if(!arguments.length)return t=t||{width:this.element[0].offsetWidth,height:this.element[0].offsetHeight};t=arguments[0]},this._addToManager(e.scope),e.addClasses&&this._addClass("ui-droppable")},_addToManager:function(t){V.ui.ddmanager.droppables[t]=V.ui.ddmanager.droppables[t]||[],V.ui.ddmanager.droppables[t].push(this)},_splice:function(t){for(var e=0;e<t.length;e++)t[e]===this&&t.splice(e,1)},_destroy:function(){var t=V.ui.ddmanager.droppables[this.options.scope];this._splice(t)},_setOption:function(t,e){var i;"accept"===t?this.accept="function"==typeof e?e:function(t){return t.is(e)}:"scope"===t&&(i=V.ui.ddmanager.droppables[this.options.scope],this._splice(i),this._addToManager(e)),this._super(t,e)},_activate:function(t){var e=V.ui.ddmanager.current;this._addActiveClass(),e&&this._trigger("activate",t,this.ui(e))},_deactivate:function(t){var e=V.ui.ddmanager.current;this._removeActiveClass(),e&&this._trigger("deactivate",t,this.ui(e))},_over:function(t){var e=V.ui.ddmanager.current;e&&(e.currentItem||e.element)[0]!==this.element[0]&&this.accept.call(this.element[0],e.currentItem||e.element)&&(this._addHoverClass(),this._trigger("over",t,this.ui(e)))},_out:function(t){var e=V.ui.ddmanager.current;e&&(e.currentItem||e.element)[0]!==this.element[0]&&this.accept.call(this.element[0],e.currentItem||e.element)&&(this._removeHoverClass(),this._trigger("out",t,this.ui(e)))},_drop:function(e,t){var i=t||V.ui.ddmanager.current,s=!1;return!(!i||(i.currentItem||i.element)[0]===this.element[0]||(this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function(){var t=V(this).droppable("instance");if(t.options.greedy&&!t.options.disabled&&t.options.scope===i.options.scope&&t.accept.call(t.element[0],i.currentItem||i.element)&&V.ui.intersect(i,V.extend(t,{offset:t.element.offset()}),t.options.tolerance,e))return!(s=!0)}),s)||!this.accept.call(this.element[0],i.currentItem||i.element))&&(this._removeActiveClass(),this._removeHoverClass(),this._trigger("drop",e,this.ui(i)),this.element)},ui:function(t){return{draggable:t.currentItem||t.element,helper:t.helper,position:t.position,offset:t.positionAbs}},_addHoverClass:function(){this._addClass("ui-droppable-hover")},_removeHoverClass:function(){this._removeClass("ui-droppable-hover")},_addActiveClass:function(){this._addClass("ui-droppable-active")},_removeActiveClass:function(){this._removeClass("ui-droppable-active")}}),V.ui.intersect=function(t,e,i,s){if(!e.offset)return!1;var n=(t.positionAbs||t.position.absolute).left+t.margins.left,o=(t.positionAbs||t.position.absolute).top+t.margins.top,a=n+t.helperProportions.width,r=o+t.helperProportions.height,l=e.offset.left,h=e.offset.top,c=l+e.proportions().width,u=h+e.proportions().height;switch(i){case"fit":return l<=n&&a<=c&&h<=o&&r<=u;case"intersect":return l<n+t.helperProportions.width/2&&a-t.helperProportions.width/2<c&&h<o+t.helperProportions.height/2&&r-t.helperProportions.height/2<u;case"pointer":return rt(s.pageY,h,e.proportions().height)&&rt(s.pageX,l,e.proportions().width);case"touch":return(h<=o&&o<=u||h<=r&&r<=u||o<h&&u<r)&&(l<=n&&n<=c||l<=a&&a<=c||n<l&&c<a);default:return!1}},V.ui.ddmanager={current:null,droppables:{default:[]},prepareOffsets:function(t,e){var i,s,n=V.ui.ddmanager.droppables[t.options.scope]||[],o=e?e.type:null,a=(t.currentItem||t.element).find(":data(ui-droppable)").addBack();t:for(i=0;i<n.length;i++)if(!(n[i].options.disabled||t&&!n[i].accept.call(n[i].element[0],t.currentItem||t.element))){for(s=0;s<a.length;s++)if(a[s]===n[i].element[0]){n[i].proportions().height=0;continue t}n[i].visible="none"!==n[i].element.css("display"),n[i].visible&&("mousedown"===o&&n[i]._activate.call(n[i],e),n[i].offset=n[i].element.offset(),n[i].proportions({width:n[i].element[0].offsetWidth,height:n[i].element[0].offsetHeight}))}},drop:function(t,e){var i=!1;return V.each((V.ui.ddmanager.droppables[t.options.scope]||[]).slice(),function(){this.options&&(!this.options.disabled&&this.visible&&V.ui.intersect(t,this,this.options.tolerance,e)&&(i=this._drop.call(this,e)||i),!this.options.disabled)&&this.visible&&this.accept.call(this.element[0],t.currentItem||t.element)&&(this.isout=!0,this.isover=!1,this._deactivate.call(this,e))}),i},dragStart:function(t,e){t.element.parentsUntil("body").on("scroll.droppable",function(){t.options.refreshPositions||V.ui.ddmanager.prepareOffsets(t,e)})},drag:function(n,o){n.options.refreshPositions&&V.ui.ddmanager.prepareOffsets(n,o),V.each(V.ui.ddmanager.droppables[n.options.scope]||[],function(){var t,e,i,s;this.options.disabled||this.greedyChild||!this.visible||(s=!(s=V.ui.intersect(n,this,this.options.tolerance,o))&&this.isover?"isout":s&&!this.isover?"isover":null)&&(this.options.greedy&&(e=this.options.scope,(i=this.element.parents(":data(ui-droppable)").filter(function(){return V(this).droppable("instance").options.scope===e})).length)&&((t=V(i[0]).droppable("instance")).greedyChild="isover"===s),t&&"isover"===s&&(t.isover=!1,t.isout=!0,t._out.call(t,o)),this[s]=!0,this["isout"===s?"isover":"isout"]=!1,this["isover"===s?"_over":"_out"].call(this,o),t)&&"isout"===s&&(t.isout=!1,t.isover=!0,t._over.call(t,o))})},dragStop:function(t,e){t.element.parentsUntil("body").off("scroll.droppable"),t.options.refreshPositions||V.ui.ddmanager.prepareOffsets(t,e)}},!0===V.uiBackCompat&&V.widget("ui.droppable",V.ui.droppable,{options:{hoverClass:!1,activeClass:!1},_addActiveClass:function(){this._super(),this.options.activeClass&&this.element.addClass(this.options.activeClass)},_removeActiveClass:function(){this._super(),this.options.activeClass&&this.element.removeClass(this.options.activeClass)},_addHoverClass:function(){this._super(),this.options.hoverClass&&this.element.addClass(this.options.hoverClass)},_removeHoverClass:function(){this._super(),this.options.hoverClass&&this.element.removeClass(this.options.hoverClass)}});V.ui.droppable,V.widget("ui.progressbar",{version:"1.14.1",options:{classes:{"ui-progressbar":"ui-corner-all","ui-progressbar-value":"ui-corner-left","ui-progressbar-complete":"ui-corner-right"},max:100,value:0,change:null,complete:null},min:0,_create:function(){this.oldValue=this.options.value=this._constrainedValue(),this.element.attr({role:"progressbar","aria-valuemin":this.min}),this._addClass("ui-progressbar","ui-widget ui-widget-content"),this.valueDiv=V("<div>").appendTo(this.element),this._addClass(this.valueDiv,"ui-progressbar-value","ui-widget-header"),this._refreshValue()},_destroy:function(){this.element.removeAttr("role aria-valuemin aria-valuemax aria-valuenow"),this.valueDiv.remove()},value:function(t){if(void 0===t)return this.options.value;this.options.value=this._constrainedValue(t),this._refreshValue()},_constrainedValue:function(t){return void 0===t&&(t=this.options.value),this.indeterminate=!1===t,"number"!=typeof t&&(t=0),!this.indeterminate&&Math.min(this.options.max,Math.max(this.min,t))},_setOptions:function(t){var e=t.value;delete t.value,this._super(t),this.options.value=this._constrainedValue(e),this._refreshValue()},_setOption:function(t,e){"max"===t&&(e=Math.max(this.min,e)),this._super(t,e)},_setOptionDisabled:function(t){this._super(t),this.element.attr("aria-disabled",t),this._toggleClass(null,"ui-state-disabled",!!t)},_percentage:function(){return this.indeterminate?100:100*(this.options.value-this.min)/(this.options.max-this.min)},_refreshValue:function(){var t=this.options.value,e=this._percentage();this.valueDiv.toggle(this.indeterminate||t>this.min).width(e.toFixed(0)+"%"),this._toggleClass(this.valueDiv,"ui-progressbar-complete",null,t===this.options.max)._toggleClass("ui-progressbar-indeterminate",null,this.indeterminate),this.indeterminate?(this.element.removeAttr("aria-valuenow"),this.overlayDiv||(this.overlayDiv=V("<div>").appendTo(this.valueDiv),this._addClass(this.overlayDiv,"ui-progressbar-overlay"))):(this.element.attr({"aria-valuemax":this.options.max,"aria-valuenow":t}),this.overlayDiv&&(this.overlayDiv.remove(),this.overlayDiv=null)),this.oldValue!==t&&(this.oldValue=t,this._trigger("change")),t===this.options.max&&this._trigger("complete")}}),V.widget("ui.selectable",V.ui.mouse,{version:"1.14.1",options:{appendTo:"body",autoRefresh:!0,distance:0,filter:"*",tolerance:"touch",selected:null,selecting:null,start:null,stop:null,unselected:null,unselecting:null},_create:function(){var i=this;this._addClass("ui-selectable"),this.dragged=!1,this.refresh=function(){i.elementPos=V(i.element[0]).offset(),i.selectees=V(i.options.filter,i.element[0]),i._addClass(i.selectees,"ui-selectee"),i.selectees.each(function(){var t=V(this),e=t.offset(),e={left:e.left-i.elementPos.left,top:e.top-i.elementPos.top};V.data(this,"selectable-item",{element:this,$element:t,left:e.left,top:e.top,right:e.left+t.outerWidth(),bottom:e.top+t.outerHeight(),startselected:!1,selected:t.hasClass("ui-selected"),selecting:t.hasClass("ui-selecting"),unselecting:t.hasClass("ui-unselecting")})})},this.refresh(),this._mouseInit(),this.helper=V("<div>"),this._addClass(this.helper,"ui-selectable-helper")},_destroy:function(){this.selectees.removeData("selectable-item"),this._mouseDestroy()},_mouseStart:function(i){var s=this,t=this.options;this.opos=[i.pageX,i.pageY],this.elementPos=V(this.element[0]).offset(),this.options.disabled||(this.selectees=V(t.filter,this.element[0]),this._trigger("start",i),V(t.appendTo).append(this.helper),this.helper.css({left:i.pageX,top:i.pageY,width:0,height:0}),t.autoRefresh&&this.refresh(),this.selectees.filter(".ui-selected").each(function(){var t=V.data(this,"selectable-item");t.startselected=!0,i.metaKey||i.ctrlKey||(s._removeClass(t.$element,"ui-selected"),t.selected=!1,s._addClass(t.$element,"ui-unselecting"),t.unselecting=!0,s._trigger("unselecting",i,{unselecting:t.element}))}),V(i.target).parents().addBack().each(function(){var t,e=V.data(this,"selectable-item");if(e)return t=!i.metaKey&&!i.ctrlKey||!e.$element.hasClass("ui-selected"),s._removeClass(e.$element,t?"ui-unselecting":"ui-selected")._addClass(e.$element,t?"ui-selecting":"ui-unselecting"),e.unselecting=!t,e.selecting=t,(e.selected=t)?s._trigger("selecting",i,{selecting:e.element}):s._trigger("unselecting",i,{unselecting:e.element}),!1}))},_mouseDrag:function(s){var t,n,o,a,r,l,h;if(this.dragged=!0,!this.options.disabled)return o=(n=this).options,a=this.opos[0],r=this.opos[1],(l=s.pageX)<a&&(t=l,l=a,a=t),(h=s.pageY)<r&&(t=h,h=r,r=t),this.helper.css({left:a,top:r,width:l-a,height:h-r}),this.selectees.each(function(){var t=V.data(this,"selectable-item"),e=!1,i={};t&&t.element!==n.element[0]&&(i.left=t.left+n.elementPos.left,i.right=t.right+n.elementPos.left,i.top=t.top+n.elementPos.top,i.bottom=t.bottom+n.elementPos.top,"touch"===o.tolerance?e=!(l<i.left||i.right<a||h<i.top||i.bottom<r):"fit"===o.tolerance&&(e=a<i.left&&i.right<l&&r<i.top&&i.bottom<h),e?(t.selected&&(n._removeClass(t.$element,"ui-selected"),t.selected=!1),t.unselecting&&(n._removeClass(t.$element,"ui-unselecting"),t.unselecting=!1),t.selecting||(n._addClass(t.$element,"ui-selecting"),t.selecting=!0,n._trigger("selecting",s,{selecting:t.element}))):(t.selecting&&((s.metaKey||s.ctrlKey)&&t.startselected?(n._removeClass(t.$element,"ui-selecting"),t.selecting=!1,n._addClass(t.$element,"ui-selected"),t.selected=!0):(n._removeClass(t.$element,"ui-selecting"),t.selecting=!1,t.startselected&&(n._addClass(t.$element,"ui-unselecting"),t.unselecting=!0),n._trigger("unselecting",s,{unselecting:t.element}))),!t.selected||s.metaKey||s.ctrlKey||t.startselected||(n._removeClass(t.$element,"ui-selected"),t.selected=!1,n._addClass(t.$element,"ui-unselecting"),t.unselecting=!0,n._trigger("unselecting",s,{unselecting:t.element}))))}),!1},_mouseStop:function(e){var i=this;return this.dragged=!1,V(".ui-unselecting",this.element[0]).each(function(){var t=V.data(this,"selectable-item");i._removeClass(t.$element,"ui-unselecting"),t.unselecting=!1,t.startselected=!1,i._trigger("unselected",e,{unselected:t.element})}),V(".ui-selecting",this.element[0]).each(function(){var t=V.data(this,"selectable-item");i._removeClass(t.$element,"ui-selecting")._addClass(t.$element,"ui-selected"),t.selecting=!1,t.selected=!0,t.startselected=!0,i._trigger("selected",e,{selected:t.element})}),this._trigger("stop",e),this.helper.remove(),!1}}),V.widget("ui.selectmenu",[V.ui.formResetMixin,{version:"1.14.1",defaultElement:"<select>",options:{appendTo:null,classes:{"ui-selectmenu-button-open":"ui-corner-top","ui-selectmenu-button-closed":"ui-corner-all"},disabled:null,icons:{button:"ui-icon-triangle-1-s"},position:{my:"left top",at:"left bottom",collision:"none"},width:!1,change:null,close:null,focus:null,open:null,select:null},_create:function(){var t=this.element.uniqueId().attr("id");this.ids={element:t,button:t+"-button",menu:t+"-menu"},this._drawButton(),this._drawMenu(),this._bindFormResetHandler(),this._rendered=!1,this.menuItems=V()},_drawButton:function(){var t,e=this,i=this._parseOption(this.element.find("option:selected"),this.element[0].selectedIndex);this.labels=this.element.labels().attr("for",this.ids.button),this._on(this.labels,{click:function(t){this.button.trigger("focus"),t.preventDefault()}}),this.element.hide(),this.button=V("<span>",{tabindex:this.options.disabled?-1:0,id:this.ids.button,role:"combobox","aria-expanded":"false","aria-autocomplete":"list","aria-owns":this.ids.menu,"aria-haspopup":"true",title:this.element.attr("title")}).insertAfter(this.element),this._addClass(this.button,"ui-selectmenu-button ui-selectmenu-button-closed","ui-button ui-widget"),t=V("<span>").appendTo(this.button),this._addClass(t,"ui-selectmenu-icon","ui-icon "+this.options.icons.button),this.buttonItem=this._renderButtonItem(i).appendTo(this.button),!1!==this.options.width&&this._resizeButton(),this._on(this.button,this._buttonEvents),this.button.one("focusin",function(){e._rendered||e._refreshMenu()})},_drawMenu:function(){var i=this;this.menu=V("<ul>",{"aria-hidden":"true","aria-labelledby":this.ids.button,id:this.ids.menu}),this.menuWrap=V("<div>").append(this.menu),this._addClass(this.menuWrap,"ui-selectmenu-menu","ui-front"),this.menuWrap.appendTo(this._appendTo()),this.menuInstance=this.menu.menu({classes:{"ui-menu":"ui-corner-bottom"},role:"listbox",select:function(t,e){t.preventDefault(),i._select(e.item.data("ui-selectmenu-item"),t)},focus:function(t,e){e=e.item.data("ui-selectmenu-item");null!=i.focusIndex&&e.index!==i.focusIndex&&(i._trigger("focus",t,{item:e}),i.isOpen||i._select(e,t)),i.focusIndex=e.index,i.button.attr("aria-activedescendant",i.menuItems.eq(e.index).attr("id"))}}).menu("instance"),this.menuInstance._off(this.menu,"mouseleave"),this.menuInstance._closeOnDocumentClick=function(){return!1},this.menuInstance._isDivider=function(){return!1}},refresh:function(){this._refreshMenu(),this.buttonItem.replaceWith(this.buttonItem=this._renderButtonItem(this._getSelectedItem().data("ui-selectmenu-item")||{})),null===this.options.width&&this._resizeButton()},_refreshMenu:function(){var t=this.element.find("option");this.menu.empty(),this._parseOptions(t),this._renderMenu(this.menu,this.items),this.menuInstance.refresh(),this.menuItems=this.menu.find("li").not(".ui-selectmenu-optgroup").find(".ui-menu-item-wrapper"),this._rendered=!0,t.length&&(t=this._getSelectedItem(),this.menuInstance.focus(null,t),this._setAria(t.data("ui-selectmenu-item")),this._setOption("disabled",this.element.prop("disabled")))},open:function(t){this.options.disabled||(this._rendered?(this._removeClass(this.menu.find(".ui-state-active"),null,"ui-state-active"),this.menuInstance.focus(null,this._getSelectedItem())):this._refreshMenu(),this.menuItems.length&&(this.isOpen=!0,this._toggleAttr(),this._resizeMenu(),this._position(),this._on(this.document,this._documentClick),this._trigger("open",t)))},_position:function(){this.menuWrap.position(V.extend({of:this.button},this.options.position))},close:function(t){this.isOpen&&(this.isOpen=!1,this._toggleAttr(),this.range=null,this._off(this.document),this._trigger("close",t))},widget:function(){return this.button},menuWidget:function(){return this.menu},_renderButtonItem:function(t){var e=V("<span>");return this._setText(e,t.label),this._addClass(e,"ui-selectmenu-text"),e},_renderMenu:function(s,t){var n=this,o="";V.each(t,function(t,e){var i;e.optgroup!==o&&(i=V("<li>",{text:e.optgroup}),n._addClass(i,"ui-selectmenu-optgroup","ui-menu-divider"+(e.element.parent("optgroup").prop("disabled")?" ui-state-disabled":"")),i.appendTo(s),o=e.optgroup),n._renderItemData(s,e)})},_renderItemData:function(t,e){return this._renderItem(t,e).data("ui-selectmenu-item",e)},_renderItem:function(t,e){var i=V("<li>"),s=V("<div>",{title:e.element.attr("title")});return e.disabled&&this._addClass(i,null,"ui-state-disabled"),e.hidden?i.prop("hidden",!0):this._setText(s,e.label),i.append(s).appendTo(t)},_setText:function(t,e){e?t.text(e):t.html("&#160;")},_move:function(t,e){var i,s=".ui-menu-item";this.isOpen?i=this.menuItems.eq(this.focusIndex).parent("li"):(i=this.menuItems.eq(this.element[0].selectedIndex).parent("li"),s+=":not(.ui-state-disabled)"),(i="first"===t||"last"===t?i["first"===t?"prevAll":"nextAll"](s).eq(-1):i[t+"All"](s).eq(0)).length&&this.menuInstance.focus(e,i)},_getSelectedItem:function(){return this.menuItems.eq(this.element[0].selectedIndex).parent("li")},_toggle:function(t){this[this.isOpen?"close":"open"](t)},_setSelection:function(){var t;this.range&&((t=window.getSelection()).removeAllRanges(),t.addRange(this.range))},_documentClick:{mousedown:function(t){!this.isOpen||V(t.target).closest(".ui-selectmenu-menu, #"+CSS.escape(this.ids.button)).length||this.close(t)}},_buttonEvents:{mousedown:function(){var t=window.getSelection();t.rangeCount&&(this.range=t.getRangeAt(0))},click:function(t){this._setSelection(),this._toggle(t)},keydown:function(t){var e=!0;switch(t.keyCode){case V.ui.keyCode.TAB:case V.ui.keyCode.ESCAPE:this.close(t),e=!1;break;case V.ui.keyCode.ENTER:this.isOpen&&this._selectFocusedItem(t);break;case V.ui.keyCode.UP:t.altKey?this._toggle(t):this._move("prev",t);break;case V.ui.keyCode.DOWN:t.altKey?this._toggle(t):this._move("next",t);break;case V.ui.keyCode.SPACE:this.isOpen?this._selectFocusedItem(t):this._toggle(t);break;case V.ui.keyCode.LEFT:this._move("prev",t);break;case V.ui.keyCode.RIGHT:this._move("next",t);break;case V.ui.keyCode.HOME:case V.ui.keyCode.PAGE_UP:this._move("first",t);break;case V.ui.keyCode.END:case V.ui.keyCode.PAGE_DOWN:this._move("last",t);break;default:this.menu.trigger(t),e=!1}e&&t.preventDefault()}},_selectFocusedItem:function(t){var e=this.menuItems.eq(this.focusIndex).parent("li");e.hasClass("ui-state-disabled")||this._select(e.data("ui-selectmenu-item"),t)},_select:function(t,e){var i=this.element[0].selectedIndex;this.element[0].selectedIndex=t.index,this.buttonItem.replaceWith(this.buttonItem=this._renderButtonItem(t)),this._setAria(t),this._trigger("select",e,{item:t}),t.index!==i&&this._trigger("change",e,{item:t}),this.close(e)},_setAria:function(t){t=this.menuItems.eq(t.index).attr("id");this.button.attr({"aria-labelledby":t,"aria-activedescendant":t}),this.menu.attr("aria-activedescendant",t)},_setOption:function(t,e){var i;"icons"===t&&(i=this.button.find("span.ui-icon"),this._removeClass(i,null,this.options.icons.button)._addClass(i,null,e.button)),this._super(t,e),"appendTo"===t&&this.menuWrap.appendTo(this._appendTo()),"width"===t&&this._resizeButton()},_setOptionDisabled:function(t){this._super(t),this.menuInstance.option("disabled",t),this.button.attr("aria-disabled",t),this._toggleClass(this.button,null,"ui-state-disabled",t),this.element.prop("disabled",t),t?(this.button.attr("tabindex",-1),this.close()):this.button.attr("tabindex",0)},_appendTo:function(){var t=this.options.appendTo;return t=(t=(t=t&&(t.jquery||t.nodeType?V(t):this.document.find(t).eq(0)))&&t[0]?t:this.element.closest(".ui-front, dialog")).length?t:this.document[0].body},_toggleAttr:function(){this.button.attr("aria-expanded",this.isOpen),this._removeClass(this.button,"ui-selectmenu-button-"+(this.isOpen?"closed":"open"))._addClass(this.button,"ui-selectmenu-button-"+(this.isOpen?"open":"closed"))._toggleClass(this.menuWrap,"ui-selectmenu-open",null,this.isOpen),this.menu.attr("aria-hidden",!this.isOpen)},_resizeButton:function(){var t=this.options.width;!1===t?this.button.css("width",""):(null===t&&(t=this.element.show().outerWidth(),this.element.hide()),this.button.outerWidth(t))},_resizeMenu:function(){this.menu.outerWidth(Math.max(this.button.outerWidth(),this.menu.width("").outerWidth()))},_getCreateOptions:function(){var t=this._super();return t.disabled=this.element.prop("disabled"),t},_parseOptions:function(t){var i=this,s=[];t.each(function(t,e){s.push(i._parseOption(V(e),t))}),this.items=s},_parseOption:function(t,e){var i=t.parent("optgroup");return{element:t,index:e,value:t.val(),label:t.text(),hidden:i.prop("hidden")||t.prop("hidden"),optgroup:i.attr("label")||"",disabled:i.prop("disabled")||t.prop("disabled")}},_destroy:function(){this._unbindFormResetHandler(),this.menuWrap.remove(),this.button.remove(),this.element.show(),this.element.removeUniqueId(),this.labels.attr("for",this.ids.element)}}]),V.widget("ui.slider",V.ui.mouse,{version:"1.14.1",widgetEventPrefix:"slide",options:{animate:!1,classes:{"ui-slider":"ui-corner-all","ui-slider-handle":"ui-corner-all","ui-slider-range":"ui-corner-all ui-widget-header"},distance:0,max:100,min:0,orientation:"horizontal",range:!1,step:1,value:0,values:null,change:null,slide:null,start:null,stop:null},numPages:5,_create:function(){this._keySliding=!1,this._mouseSliding=!1,this._animateOff=!0,this._handleIndex=null,this._detectOrientation(),this._mouseInit(),this._calculateNewMax(),this._addClass("ui-slider ui-slider-"+this.orientation,"ui-widget ui-widget-content"),this._refresh(),this._animateOff=!1},_refresh:function(){this._createRange(),this._createHandles(),this._setupEvents(),this._refreshValue()},_createHandles:function(){var t,e=this.options,i=this.element.find(".ui-slider-handle"),s=[],n=e.values&&e.values.length||1;for(i.length>n&&(i.slice(n).remove(),i=i.slice(0,n)),t=i.length;t<n;t++)s.push("<span tabindex='0'></span>");this.handles=i.add(V(s.join("")).appendTo(this.element)),this._addClass(this.handles,"ui-slider-handle","ui-state-default"),this.handle=this.handles.eq(0),this.handles.each(function(t){V(this).data("ui-slider-handle-index",t).attr("tabIndex",0)})},_createRange:function(){var t=this.options;t.range?(!0===t.range&&(t.values?t.values.length&&2!==t.values.length?t.values=[t.values[0],t.values[0]]:Array.isArray(t.values)&&(t.values=t.values.slice(0)):t.values=[this._valueMin(),this._valueMin()]),this.range&&this.range.length?(this._removeClass(this.range,"ui-slider-range-min ui-slider-range-max"),this.range.css({left:"",bottom:""})):(this.range=V("<div>").appendTo(this.element),this._addClass(this.range,"ui-slider-range")),"min"!==t.range&&"max"!==t.range||this._addClass(this.range,"ui-slider-range-"+t.range)):(this.range&&this.range.remove(),this.range=null)},_setupEvents:function(){this._off(this.handles),this._on(this.handles,this._handleEvents),this._hoverable(this.handles),this._focusable(this.handles)},_destroy:function(){this.handles.remove(),this.range&&this.range.remove(),this._mouseDestroy()},_mouseCapture:function(t){var i,s,n,o,e,a,r=this,l=this.options;return!l.disabled&&(this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()},this.elementOffset=this.element.offset(),e={x:t.pageX,y:t.pageY},i=this._normValueFromMouse(e),s=this._valueMax()-this._valueMin()+1,this.handles.each(function(t){var e=Math.abs(i-r.values(t));(e<s||s===e&&(t===r._lastChangedValue||r.values(t)===l.min))&&(s=e,n=V(this),o=t)}),!1!==this._start(t,o))&&(this._mouseSliding=!0,this._handleIndex=o,this._addClass(n,null,"ui-state-active"),n.trigger("focus"),e=n.offset(),a=!V(t.target).parents().addBack().is(".ui-slider-handle"),this._clickOffset=a?{left:0,top:0}:{left:t.pageX-e.left-n.width()/2,top:t.pageY-e.top-n.height()/2-(parseInt(n.css("borderTopWidth"),10)||0)-(parseInt(n.css("borderBottomWidth"),10)||0)+(parseInt(n.css("marginTop"),10)||0)},this.handles.hasClass("ui-state-hover")||this._slide(t,o,i),this._animateOff=!0)},_mouseStart:function(){return!0},_mouseDrag:function(t){var e={x:t.pageX,y:t.pageY},e=this._normValueFromMouse(e);return this._slide(t,this._handleIndex,e),!1},_mouseStop:function(t){return this._removeClass(this.handles,null,"ui-state-active"),this._mouseSliding=!1,this._stop(t,this._handleIndex),this._change(t,this._handleIndex),this._handleIndex=null,this._clickOffset=null,this._animateOff=!1},_detectOrientation:function(){this.orientation="vertical"===this.options.orientation?"vertical":"horizontal"},_normValueFromMouse:function(t){var e,t="horizontal"===this.orientation?(e=this.elementSize.width,t.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)):(e=this.elementSize.height,t.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)),t=t/e;return(t=1<t?1:t)<0&&(t=0),"vertical"===this.orientation&&(t=1-t),e=this._valueMax()-this._valueMin(),t=this._valueMin()+t*e,this._trimAlignValue(t)},_uiHash:function(t,e,i){var s={handle:this.handles[t],handleIndex:t,value:void 0!==e?e:this.value()};return this._hasMultipleValues()&&(s.value=void 0!==e?e:this.values(t),s.values=i||this.values()),s},_hasMultipleValues:function(){return this.options.values&&this.options.values.length},_start:function(t,e){return this._trigger("start",t,this._uiHash(e))},_slide:function(t,e,i){var s,n=this.value(),o=this.values();this._hasMultipleValues()&&(s=this.values(e?0:1),n=this.values(e),2===this.options.values.length&&!0===this.options.range&&(i=0===e?Math.min(s,i):Math.max(s,i)),o[e]=i),i!==n&&!1!==this._trigger("slide",t,this._uiHash(e,i,o))&&(this._hasMultipleValues()?this.values(e,i):this.value(i))},_stop:function(t,e){this._trigger("stop",t,this._uiHash(e))},_change:function(t,e){this._keySliding||this._mouseSliding||(this._lastChangedValue=e,this._trigger("change",t,this._uiHash(e)))},value:function(t){if(!arguments.length)return this._value();this.options.value=this._trimAlignValue(t),this._refreshValue(),this._change(null,0)},values:function(t,e){var i,s,n;if(1<arguments.length)this.options.values[t]=this._trimAlignValue(e),this._refreshValue(),this._change(null,t);else{if(!arguments.length)return this._values();if(!Array.isArray(t))return this._hasMultipleValues()?this._values(t):this.value();for(i=this.options.values,s=t,n=0;n<i.length;n+=1)i[n]=this._trimAlignValue(s[n]),this._change(null,n);this._refreshValue()}},_setOption:function(t,e){var i,s=0;switch("range"===t&&!0===this.options.range&&("min"===e?(this.options.value=this._values(0),this.options.values=null):"max"===e&&(this.options.value=this._values(this.options.values.length-1),this.options.values=null)),Array.isArray(this.options.values)&&(s=this.options.values.length),this._super(t,e),t){case"orientation":this._detectOrientation(),this._removeClass("ui-slider-horizontal ui-slider-vertical")._addClass("ui-slider-"+this.orientation),this._refreshValue(),this.options.range&&this._refreshRange(e),this.handles.css("horizontal"===e?"bottom":"left","");break;case"value":this._animateOff=!0,this._refreshValue(),this._change(null,0),this._animateOff=!1;break;case"values":for(this._animateOff=!0,this._refreshValue(),i=s-1;0<=i;i--)this._change(null,i);this._animateOff=!1;break;case"step":case"min":case"max":this._animateOff=!0,this._calculateNewMax(),this._refreshValue(),this._animateOff=!1;break;case"range":this._animateOff=!0,this._refresh(),this._animateOff=!1}},_setOptionDisabled:function(t){this._super(t),this._toggleClass(null,"ui-state-disabled",!!t)},_value:function(){var t=this.options.value;return this._trimAlignValue(t)},_values:function(t){var e,i;if(arguments.length)return t=this.options.values[t],this._trimAlignValue(t);if(this._hasMultipleValues()){for(e=this.options.values.slice(),i=0;i<e.length;i+=1)e[i]=this._trimAlignValue(e[i]);return e}return[]},_trimAlignValue:function(t){var e,i;return t<=this._valueMin()?this._valueMin():t>=this._valueMax()?this._valueMax():(e=0<this.options.step?this.options.step:1,i=t-(t=(t-this._valueMin())%e),2*Math.abs(t)>=e&&(i+=0<t?e:-e),parseFloat(i.toFixed(5)))},_calculateNewMax:function(){var t=this.options.max,e=this._valueMin(),i=this.options.step;(t=Math.round((t-e)/i)*i+e)>this.options.max&&(t-=i),this.max=parseFloat(t.toFixed(this._precision()))},_precision:function(){var t=this._precisionOf(this.options.step);return t=null!==this.options.min?Math.max(t,this._precisionOf(this.options.min)):t},_precisionOf:function(t){var t=t.toString(),e=t.indexOf(".");return-1===e?0:t.length-e-1},_valueMin:function(){return this.options.min},_valueMax:function(){return this.max},_refreshRange:function(t){"vertical"===t&&this.range.css({width:"",left:""}),"horizontal"===t&&this.range.css({height:"",bottom:""})},_refreshValue:function(){var e,i,t,s,n,o=this.options.range,a=this.options,r=this,l=!this._animateOff&&a.animate,h={};this._hasMultipleValues()?this.handles.each(function(t){i=(r.values(t)-r._valueMin())/(r._valueMax()-r._valueMin())*100,h["horizontal"===r.orientation?"left":"bottom"]=i+"%",V(this).stop(1,1)[l?"animate":"css"](h,a.animate),!0===r.options.range&&("horizontal"===r.orientation?(0===t&&r.range.stop(1,1)[l?"animate":"css"]({left:i+"%"},a.animate),1===t&&r.range[l?"animate":"css"]({width:i-e+"%"},{queue:!1,duration:a.animate})):(0===t&&r.range.stop(1,1)[l?"animate":"css"]({bottom:i+"%"},a.animate),1===t&&r.range[l?"animate":"css"]({height:i-e+"%"},{queue:!1,duration:a.animate}))),e=i}):(t=this.value(),s=this._valueMin(),n=this._valueMax(),i=n!==s?(t-s)/(n-s)*100:0,h["horizontal"===this.orientation?"left":"bottom"]=i+"%",this.handle.stop(1,1)[l?"animate":"css"](h,a.animate),"min"===o&&"horizontal"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({width:i+"%"},a.animate),"max"===o&&"horizontal"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({width:100-i+"%"},a.animate),"min"===o&&"vertical"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({height:i+"%"},a.animate),"max"===o&&"vertical"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({height:100-i+"%"},a.animate))},_handleEvents:{keydown:function(t){var e,i,s,n=V(t.target).data("ui-slider-handle-index");switch(t.keyCode){case V.ui.keyCode.HOME:case V.ui.keyCode.END:case V.ui.keyCode.PAGE_UP:case V.ui.keyCode.PAGE_DOWN:case V.ui.keyCode.UP:case V.ui.keyCode.RIGHT:case V.ui.keyCode.DOWN:case V.ui.keyCode.LEFT:if(t.preventDefault(),this._keySliding||(this._keySliding=!0,this._addClass(V(t.target),null,"ui-state-active"),!1!==this._start(t,n)))break;return}switch(s=this.options.step,e=i=this._hasMultipleValues()?this.values(n):this.value(),t.keyCode){case V.ui.keyCode.HOME:i=this._valueMin();break;case V.ui.keyCode.END:i=this._valueMax();break;case V.ui.keyCode.PAGE_UP:i=this._trimAlignValue(e+(this._valueMax()-this._valueMin())/this.numPages);break;case V.ui.keyCode.PAGE_DOWN:i=this._trimAlignValue(e-(this._valueMax()-this._valueMin())/this.numPages);break;case V.ui.keyCode.UP:case V.ui.keyCode.RIGHT:if(e===this._valueMax())return;i=this._trimAlignValue(e+s);break;case V.ui.keyCode.DOWN:case V.ui.keyCode.LEFT:if(e===this._valueMin())return;i=this._trimAlignValue(e-s)}this._slide(t,n,i)},keyup:function(t){var e=V(t.target).data("ui-slider-handle-index");this._keySliding&&(this._keySliding=!1,this._stop(t,e),this._change(t,e),this._removeClass(V(t.target),null,"ui-state-active"))}}}),V.widget("ui.sortable",V.ui.mouse,{version:"1.14.1",widgetEventPrefix:"sort",ready:!1,options:{appendTo:"parent",axis:!1,connectWith:!1,containment:!1,cursor:"auto",cursorAt:!1,dropOnEmpty:!0,forcePlaceholderSize:!1,forceHelperSize:!1,grid:!1,handle:!1,helper:"original",items:"> *",opacity:!1,placeholder:!1,revert:!1,scroll:!0,scrollSensitivity:20,scrollSpeed:20,scope:"default",tolerance:"intersect",zIndex:1e3,activate:null,beforeStop:null,change:null,deactivate:null,out:null,over:null,receive:null,remove:null,sort:null,start:null,stop:null,update:null},_isOverAxis:function(t,e,i){return e<=t&&t<e+i},_isFloating:function(t){return/left|right/.test(t.css("float"))||/inline|table-cell/.test(t.css("display"))},_create:function(){this.containerCache={},this._addClass("ui-sortable"),this.refresh(),this.offset=this.element.offset(),this._mouseInit(),this._setHandleClassName(),this.ready=!0},_setOption:function(t,e){this._super(t,e),"handle"===t&&this._setHandleClassName()},_setHandleClassName:function(){var t=this;this._removeClass(this.element.find(".ui-sortable-handle"),"ui-sortable-handle"),V.each(this.items,function(){t._addClass(this.instance.options.handle?this.item.find(this.instance.options.handle):this.item,"ui-sortable-handle")})},_destroy:function(){this._mouseDestroy();for(var t=this.items.length-1;0<=t;t--)this.items[t].item.removeData(this.widgetName+"-item");return this},_mouseCapture:function(t,e){var i=null,s=!1,n=this;return!(this.reverting||this.options.disabled||"static"===this.options.type||(this._refreshItems(t),V(t.target).parents().each(function(){if(V.data(this,n.widgetName+"-item")===n)return i=V(this),!1}),!(i=V.data(t.target,n.widgetName+"-item")===n?V(t.target):i))||(this.options.handle&&!e&&(V(this.options.handle,i).find("*").addBack().each(function(){this===t.target&&(s=!0)}),!s)||(this.currentItem=i,this._removeCurrentsFromItems(),0)))},_mouseStart:function(t,e,i){var s,n,o=this.options;if((this.currentContainer=this).refreshPositions(),this.appendTo=V("parent"!==o.appendTo?o.appendTo:this.currentItem.parent()),this.helper=this._createHelper(t),this._cacheHelperProportions(),this._cacheMargins(),this.offset=this.currentItem.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},V.extend(this.offset,{click:{left:t.pageX-this.offset.left,top:t.pageY-this.offset.top},relative:this._getRelativeOffset()}),this.helper.css("position","absolute"),this.cssPosition=this.helper.css("position"),o.cursorAt&&this._adjustOffsetFromHelper(o.cursorAt),this.domPosition={prev:this.currentItem.prev()[0],parent:this.currentItem.parent()[0]},this.helper[0]!==this.currentItem[0]&&this.currentItem.hide(),this._createPlaceholder(),this.scrollParent=this.placeholder.scrollParent(),V.extend(this.offset,{parent:this._getParentOffset()}),o.containment&&this._setContainment(),o.cursor&&"auto"!==o.cursor&&(n=this.document.find("body"),this._storedStylesheet=V("<style>*{ cursor: "+o.cursor+" !important; }</style>").appendTo(n)),o.zIndex&&(this.helper.css("zIndex")&&(this._storedZIndex=this.helper.css("zIndex")),this.helper.css("zIndex",o.zIndex)),o.opacity&&(this.helper.css("opacity")&&(this._storedOpacity=this.helper.css("opacity")),this.helper.css("opacity",o.opacity)),this.scrollParent[0]!==this.document[0]&&"HTML"!==this.scrollParent[0].tagName&&(this.overflowOffset=this.scrollParent.offset()),this._trigger("start",t,this._uiHash()),this._preserveHelperProportions||this._cacheHelperProportions(),!i)for(s=this.containers.length-1;0<=s;s--)this.containers[s]._trigger("activate",t,this._uiHash(this));return V.ui.ddmanager&&(V.ui.ddmanager.current=this),V.ui.ddmanager&&!o.dropBehaviour&&V.ui.ddmanager.prepareOffsets(this,t),this.dragging=!0,this._addClass(this.helper,"ui-sortable-helper"),this.helper.parent().is(this.appendTo)||(this.helper.detach().appendTo(this.appendTo),this.offset.parent=this._getParentOffset()),this.position=this.originalPosition=this._generatePosition(t),this.originalPageX=t.pageX,this.originalPageY=t.pageY,this.lastPositionAbs=this.positionAbs=this._convertPositionTo("absolute"),this._mouseDrag(t),!0},_scroll:function(t){var e=this.options,i=!1;return this.scrollParent[0]!==this.document[0]&&"HTML"!==this.scrollParent[0].tagName?(this.overflowOffset.top+this.scrollParent[0].offsetHeight-t.pageY<e.scrollSensitivity?this.scrollParent[0].scrollTop=i=this.scrollParent[0].scrollTop+e.scrollSpeed:t.pageY-this.overflowOffset.top<e.scrollSensitivity&&(this.scrollParent[0].scrollTop=i=this.scrollParent[0].scrollTop-e.scrollSpeed),this.overflowOffset.left+this.scrollParent[0].offsetWidth-t.pageX<e.scrollSensitivity?this.scrollParent[0].scrollLeft=i=this.scrollParent[0].scrollLeft+e.scrollSpeed:t.pageX-this.overflowOffset.left<e.scrollSensitivity&&(this.scrollParent[0].scrollLeft=i=this.scrollParent[0].scrollLeft-e.scrollSpeed)):(t.pageY-this.document.scrollTop()<e.scrollSensitivity?i=this.document.scrollTop(this.document.scrollTop()-e.scrollSpeed):this.window.height()-(t.pageY-this.document.scrollTop())<e.scrollSensitivity&&(i=this.document.scrollTop(this.document.scrollTop()+e.scrollSpeed)),t.pageX-this.document.scrollLeft()<e.scrollSensitivity?i=this.document.scrollLeft(this.document.scrollLeft()-e.scrollSpeed):this.window.width()-(t.pageX-this.document.scrollLeft())<e.scrollSensitivity&&(i=this.document.scrollLeft(this.document.scrollLeft()+e.scrollSpeed))),i},_mouseDrag:function(t){var e,i,s,n,o=this.options;for(this.position=this._generatePosition(t),this.positionAbs=this._convertPositionTo("absolute"),this.options.axis&&"y"===this.options.axis||(this.helper[0].style.left=this.position.left+"px"),this.options.axis&&"x"===this.options.axis||(this.helper[0].style.top=this.position.top+"px"),o.scroll&&!1!==this._scroll(t)&&(this._refreshItemPositions(!0),V.ui.ddmanager)&&!o.dropBehaviour&&V.ui.ddmanager.prepareOffsets(this,t),this.dragDirection={vertical:this._getDragVerticalDirection(),horizontal:this._getDragHorizontalDirection()},e=this.items.length-1;0<=e;e--)if(s=(i=this.items[e]).item[0],(n=this._intersectsWithPointer(i))&&i.instance===this.currentContainer&&!(s===this.currentItem[0]||this.placeholder[1===n?"next":"prev"]()[0]===s||V.contains(this.placeholder[0],s)||"semi-dynamic"===this.options.type&&V.contains(this.element[0],s))){if(this.direction=1===n?"down":"up","pointer"!==this.options.tolerance&&!this._intersectsWithSides(i))break;this._rearrange(t,i),this._trigger("change",t,this._uiHash());break}return this._contactContainers(t),V.ui.ddmanager&&V.ui.ddmanager.drag(this,t),this._trigger("sort",t,this._uiHash()),this.lastPositionAbs=this.positionAbs,!1},_mouseStop:function(t,e){var i,s,n,o;if(t)return V.ui.ddmanager&&!this.options.dropBehaviour&&V.ui.ddmanager.drop(this,t),this.options.revert?(s=(i=this).placeholder.offset(),o={},(n=this.options.axis)&&"x"!==n||(o.left=s.left-this.offset.parent.left-this.margins.left+(this.offsetParent[0]===this.document[0].body?0:this.offsetParent[0].scrollLeft)),n&&"y"!==n||(o.top=s.top-this.offset.parent.top-this.margins.top+(this.offsetParent[0]===this.document[0].body?0:this.offsetParent[0].scrollTop)),this.reverting=!0,V(this.helper).animate(o,parseInt(this.options.revert,10)||500,function(){i._clear(t)})):this._clear(t,e),!1},cancel:function(){if(this.dragging){this._mouseUp(new V.Event("mouseup",{target:null})),"original"===this.options.helper?(this.currentItem.css(this._storedCSS),this._removeClass(this.currentItem,"ui-sortable-helper")):this.currentItem.show();for(var t=this.containers.length-1;0<=t;t--)this.containers[t]._trigger("deactivate",null,this._uiHash(this)),this.containers[t].containerCache.over&&(this.containers[t]._trigger("out",null,this._uiHash(this)),this.containers[t].containerCache.over=0)}return this.placeholder&&(this.placeholder[0].parentNode&&this.placeholder[0].parentNode.removeChild(this.placeholder[0]),"original"!==this.options.helper&&this.helper&&this.helper[0].parentNode&&this.helper.remove(),V.extend(this,{helper:null,dragging:!1,reverting:!1,_noFinalSort:null}),this.domPosition.prev?V(this.domPosition.prev).after(this.currentItem):V(this.domPosition.parent).prepend(this.currentItem)),this},serialize:function(e){var t=this._getItemsAsjQuery(e&&e.connected),i=[];return e=e||{},V(t).each(function(){var t=(V(e.item||this).attr(e.attribute||"id")||"").match(e.expression||/(.+)[\-=_](.+)/);t&&i.push((e.key||t[1]+"[]")+"="+(e.key&&e.expression?t[1]:t[2]))}),!i.length&&e.key&&i.push(e.key+"="),i.join("&")},toArray:function(t){var e=this._getItemsAsjQuery(t&&t.connected),i=[];return t=t||{},e.each(function(){i.push(V(t.item||this).attr(t.attribute||"id")||"")}),i},_intersectsWith:function(t){var e=this.positionAbs.left,i=e+this.helperProportions.width,s=this.positionAbs.top,n=s+this.helperProportions.height,o=t.left,a=o+t.width,r=t.top,l=r+t.height,h=this.offset.click.top,c=this.offset.click.left,h="x"===this.options.axis||r<s+h&&s+h<l,c="y"===this.options.axis||o<e+c&&e+c<a;return"pointer"===this.options.tolerance||this.options.forcePointerForContainers||"pointer"!==this.options.tolerance&&this.helperProportions[this.floating?"width":"height"]>t[this.floating?"width":"height"]?h&&c:o<e+this.helperProportions.width/2&&i-this.helperProportions.width/2<a&&r<s+this.helperProportions.height/2&&n-this.helperProportions.height/2<l},_intersectsWithPointer:function(t){var e="x"===this.options.axis||this._isOverAxis(this.positionAbs.top+this.offset.click.top,t.top,t.height),t="y"===this.options.axis||this._isOverAxis(this.positionAbs.left+this.offset.click.left,t.left,t.width);return!(!e||!t)&&(e=this.dragDirection.vertical,t=this.dragDirection.horizontal,this.floating?"right"===t||"down"===e?2:1:e&&("down"===e?2:1))},_intersectsWithSides:function(t){var e=this._isOverAxis(this.positionAbs.top+this.offset.click.top,t.top+t.height/2,t.height),t=this._isOverAxis(this.positionAbs.left+this.offset.click.left,t.left+t.width/2,t.width),i=this.dragDirection.vertical,s=this.dragDirection.horizontal;return this.floating&&s?"right"===s&&t||"left"===s&&!t:i&&("down"===i&&e||"up"===i&&!e)},_getDragVerticalDirection:function(){var t=this.positionAbs.top-this.lastPositionAbs.top;return 0!=t&&(0<t?"down":"up")},_getDragHorizontalDirection:function(){var t=this.positionAbs.left-this.lastPositionAbs.left;return 0!=t&&(0<t?"right":"left")},refresh:function(t){return this._refreshItems(t),this._setHandleClassName(),this.refreshPositions(),this},_connectWith:function(){var t=this.options;return t.connectWith.constructor===String?[t.connectWith]:t.connectWith},_getItemsAsjQuery:function(t){var e,i,s,n,o=[],a=[],r=this._connectWith();if(r&&t)for(e=r.length-1;0<=e;e--)for(i=(s=V(r[e],this.document[0])).length-1;0<=i;i--)(n=V.data(s[i],this.widgetFullName))&&n!==this&&!n.options.disabled&&a.push(["function"==typeof n.options.items?n.options.items.call(n.element):V(n.options.items,n.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),n]);function l(){o.push(this)}for(a.push(["function"==typeof this.options.items?this.options.items.call(this.element,null,{options:this.options,item:this.currentItem}):V(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),this]),e=a.length-1;0<=e;e--)a[e][0].each(l);return V(o)},_removeCurrentsFromItems:function(){var i=this.currentItem.find(":data("+this.widgetName+"-item)");this.items=V.grep(this.items,function(t){for(var e=0;e<i.length;e++)if(i[e]===t.item[0])return!1;return!0})},_refreshItems:function(t){this.items=[],this.containers=[this];var e,i,s,n,o,a,r,l,h=this.items,c=[["function"==typeof this.options.items?this.options.items.call(this.element[0],t,{item:this.currentItem}):V(this.options.items,this.element),this]],u=this._connectWith();if(u&&this.ready)for(e=u.length-1;0<=e;e--)for(i=(s=V(u[e],this.document[0])).length-1;0<=i;i--)(n=V.data(s[i],this.widgetFullName))&&n!==this&&!n.options.disabled&&(c.push(["function"==typeof n.options.items?n.options.items.call(n.element[0],t,{item:this.currentItem}):V(n.options.items,n.element),n]),this.containers.push(n));for(e=c.length-1;0<=e;e--)for(o=c[e][1],l=(a=c[e][i=0]).length;i<l;i++)(r=V(a[i])).data(this.widgetName+"-item",o),h.push({item:r,instance:o,width:0,height:0,left:0,top:0})},_refreshItemPositions:function(t){for(var e,i,s=this.items.length-1;0<=s;s--)e=this.items[s],this.currentContainer&&e.instance!==this.currentContainer&&e.item[0]!==this.currentItem[0]||(i=this.options.toleranceElement?V(this.options.toleranceElement,e.item):e.item,t||(e.width=i.outerWidth(),e.height=i.outerHeight()),i=i.offset(),e.left=i.left,e.top=i.top)},refreshPositions:function(t){var e,i;if(this.floating=!!this.items.length&&("x"===this.options.axis||this._isFloating(this.items[0].item)),this.offsetParent&&this.helper&&(this.offset.parent=this._getParentOffset()),this._refreshItemPositions(t),this.options.custom&&this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this);else for(e=this.containers.length-1;0<=e;e--)i=this.containers[e].element.offset(),this.containers[e].containerCache.left=i.left,this.containers[e].containerCache.top=i.top,this.containers[e].containerCache.width=this.containers[e].element.outerWidth(),this.containers[e].containerCache.height=this.containers[e].element.outerHeight();return this},_createPlaceholder:function(i){var s,n,o=(i=i||this).options;o.placeholder&&o.placeholder.constructor!==String||(s=o.placeholder,n=i.currentItem[0].nodeName.toLowerCase(),o.placeholder={element:function(){var t=V("<"+n+">",i.document[0]);return i._addClass(t,"ui-sortable-placeholder",s||i.currentItem[0].className)._removeClass(t,"ui-sortable-helper"),"tbody"===n?i._createTrPlaceholder(i.currentItem.find("tr").eq(0),V("<tr>",i.document[0]).appendTo(t)):"tr"===n?i._createTrPlaceholder(i.currentItem,t):"img"===n&&t.attr("src",i.currentItem.attr("src")),s||t.css("visibility","hidden"),t},update:function(t,e){s&&!o.forcePlaceholderSize||(e.height()&&(!o.forcePlaceholderSize||"tbody"!==n&&"tr"!==n)||e.height(i.currentItem.innerHeight()-parseInt(i.currentItem.css("paddingTop")||0,10)-parseInt(i.currentItem.css("paddingBottom")||0,10)),e.width())||e.width(i.currentItem.innerWidth()-parseInt(i.currentItem.css("paddingLeft")||0,10)-parseInt(i.currentItem.css("paddingRight")||0,10))}}),i.placeholder=V(o.placeholder.element.call(i.element,i.currentItem)),i.currentItem.after(i.placeholder),o.placeholder.update(i,i.placeholder)},_createTrPlaceholder:function(t,e){var i=this;t.children().each(function(){V("<td>&#160;</td>",i.document[0]).attr("colspan",V(this).attr("colspan")||1).appendTo(e)})},_contactContainers:function(t){for(var e,i,s,n,o,a,r,l,h,c=null,u=null,d=this.containers.length-1;0<=d;d--)V.contains(this.currentItem[0],this.containers[d].element[0])||(this._intersectsWith(this.containers[d].containerCache)?c&&V.contains(this.containers[d].element[0],c.element[0])||(c=this.containers[d],u=d):this.containers[d].containerCache.over&&(this.containers[d]._trigger("out",t,this._uiHash(this)),this.containers[d].containerCache.over=0));if(c)if(1===this.containers.length)this.containers[u].containerCache.over||(this.containers[u]._trigger("over",t,this._uiHash(this)),this.containers[u].containerCache.over=1);else{for(i=1e4,s=null,n=(l=c.floating||this._isFloating(this.currentItem))?"left":"top",o=l?"width":"height",h=l?"pageX":"pageY",e=this.items.length-1;0<=e;e--)V.contains(this.containers[u].element[0],this.items[e].item[0])&&this.items[e].item[0]!==this.currentItem[0]&&(a=this.items[e].item.offset()[n],r=!1,t[h]-a>this.items[e][o]/2&&(r=!0),Math.abs(t[h]-a)<i)&&(i=Math.abs(t[h]-a),s=this.items[e],this.direction=r?"up":"down");(s||this.options.dropOnEmpty)&&(this.currentContainer===this.containers[u]?this.currentContainer.containerCache.over||(this.containers[u]._trigger("over",t,this._uiHash()),this.currentContainer.containerCache.over=1):(s?this._rearrange(t,s,null,!0):this._rearrange(t,null,this.containers[u].element,!0),this._trigger("change",t,this._uiHash()),this.containers[u]._trigger("change",t,this._uiHash(this)),this.currentContainer=this.containers[u],this.options.placeholder.update(this.currentContainer,this.placeholder),this.scrollParent=this.placeholder.scrollParent(),this.scrollParent[0]!==this.document[0]&&"HTML"!==this.scrollParent[0].tagName&&(this.overflowOffset=this.scrollParent.offset()),this.containers[u]._trigger("over",t,this._uiHash(this)),this.containers[u].containerCache.over=1))}},_createHelper:function(t){var e=this.options,t="function"==typeof e.helper?V(e.helper.apply(this.element[0],[t,this.currentItem])):"clone"===e.helper?this.currentItem.clone():this.currentItem;return t.parents("body").length||this.appendTo[0].appendChild(t[0]),t[0]===this.currentItem[0]&&(this._storedCSS={width:this.currentItem[0].style.width,height:this.currentItem[0].style.height,position:this.currentItem.css("position"),top:this.currentItem.css("top"),left:this.currentItem.css("left")}),t[0].style.width&&!e.forceHelperSize||t.width(this.currentItem.width()),t[0].style.height&&!e.forceHelperSize||t.height(this.currentItem.height()),t},_adjustOffsetFromHelper:function(t){"string"==typeof t&&(t=t.split(" ")),"left"in(t=Array.isArray(t)?{left:+t[0],top:+t[1]||0}:t)&&(this.offset.click.left=t.left+this.margins.left),"right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left),"top"in t&&(this.offset.click.top=t.top+this.margins.top),"bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var t=this.offsetParent.offset();return"absolute"===this.cssPosition&&this.scrollParent[0]!==this.document[0]&&V.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),{top:(t=this.offsetParent[0]===this.document[0].body?{top:0,left:0}:t).top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){var t;return"relative"===this.cssPosition?{top:(t=this.currentItem.position()).top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:t.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}:{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.currentItem.css("marginLeft"),10)||0,top:parseInt(this.currentItem.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t,e,i=this.options;"parent"===i.containment&&(i.containment=this.helper[0].parentNode),"document"!==i.containment&&"window"!==i.containment||(this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,"document"===i.containment?this.document.width():this.window.width()-this.helperProportions.width-this.margins.left,("document"===i.containment?this.document.height()||document.body.parentNode.scrollHeight:this.window.height()||this.document[0].body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]),/^(document|window|parent)$/.test(i.containment)||(t=V(i.containment)[0],i=V(i.containment).offset(),e="hidden"!==V(t).css("overflow"),this.containment=[i.left+(parseInt(V(t).css("borderLeftWidth"),10)||0)+(parseInt(V(t).css("paddingLeft"),10)||0)-this.margins.left,i.top+(parseInt(V(t).css("borderTopWidth"),10)||0)+(parseInt(V(t).css("paddingTop"),10)||0)-this.margins.top,i.left+(e?Math.max(t.scrollWidth,t.offsetWidth):t.offsetWidth)-(parseInt(V(t).css("borderLeftWidth"),10)||0)-(parseInt(V(t).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,i.top+(e?Math.max(t.scrollHeight,t.offsetHeight):t.offsetHeight)-(parseInt(V(t).css("borderTopWidth"),10)||0)-(parseInt(V(t).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top])},_convertPositionTo:function(t,e){e=e||this.position;var t="absolute"===t?1:-1,i="absolute"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&V.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,s=/(html|body)/i.test(i[0].tagName);return{top:e.top+this.offset.relative.top*t+this.offset.parent.top*t-("fixed"===this.cssPosition?-this.scrollParent.scrollTop():s?0:i.scrollTop())*t,left:e.left+this.offset.relative.left*t+this.offset.parent.left*t-("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():s?0:i.scrollLeft())*t}},_generatePosition:function(t){var e=this.options,i=t.pageX,s=t.pageY,n="absolute"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&V.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,o=/(html|body)/i.test(n[0].tagName);return"relative"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&this.scrollParent[0]!==this.offsetParent[0]||(this.offset.relative=this._getRelativeOffset()),this.originalPosition&&(this.containment&&(t.pageX-this.offset.click.left<this.containment[0]&&(i=this.containment[0]+this.offset.click.left),t.pageY-this.offset.click.top<this.containment[1]&&(s=this.containment[1]+this.offset.click.top),t.pageX-this.offset.click.left>this.containment[2]&&(i=this.containment[2]+this.offset.click.left),t.pageY-this.offset.click.top>this.containment[3])&&(s=this.containment[3]+this.offset.click.top),e.grid)&&(t=this.originalPageY+Math.round((s-this.originalPageY)/e.grid[1])*e.grid[1],s=!this.containment||t-this.offset.click.top>=this.containment[1]&&t-this.offset.click.top<=this.containment[3]?t:t-this.offset.click.top>=this.containment[1]?t-e.grid[1]:t+e.grid[1],t=this.originalPageX+Math.round((i-this.originalPageX)/e.grid[0])*e.grid[0],i=!this.containment||t-this.offset.click.left>=this.containment[0]&&t-this.offset.click.left<=this.containment[2]?t:t-this.offset.click.left>=this.containment[0]?t-e.grid[0]:t+e.grid[0]),{top:s-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.scrollParent.scrollTop():o?0:n.scrollTop()),left:i-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():o?0:n.scrollLeft())}},_rearrange:function(t,e,i,s){i?i[0].appendChild(this.placeholder[0]):e.item[0].parentNode.insertBefore(this.placeholder[0],"down"===this.direction?e.item[0]:e.item[0].nextSibling),this.counter=this.counter?++this.counter:1;var n=this.counter;this._delay(function(){n===this.counter&&this.refreshPositions(!s)})},_clear:function(t,e){this.reverting=!1;var i,s=[];if(!this._noFinalSort&&this.currentItem.parent().length&&this.placeholder.before(this.currentItem),this._noFinalSort=null,this.helper[0]===this.currentItem[0]){for(i in this._storedCSS)"auto"!==this._storedCSS[i]&&"static"!==this._storedCSS[i]||(this._storedCSS[i]="");this.currentItem.css(this._storedCSS),this._removeClass(this.currentItem,"ui-sortable-helper")}else this.currentItem.show();function n(e,i,s){return function(t){s._trigger(e,t,i._uiHash(i))}}for(this.fromOutside&&!e&&s.push(function(t){this._trigger("receive",t,this._uiHash(this.fromOutside))}),!this.fromOutside&&this.domPosition.prev===this.currentItem.prev().not(".ui-sortable-helper")[0]&&this.domPosition.parent===this.currentItem.parent()[0]||e||s.push(function(t){this._trigger("update",t,this._uiHash())}),this===this.currentContainer||e||(s.push(function(t){this._trigger("remove",t,this._uiHash())}),s.push(function(e){return function(t){e._trigger("receive",t,this._uiHash(this))}}.call(this,this.currentContainer)),s.push(function(e){return function(t){e._trigger("update",t,this._uiHash(this))}}.call(this,this.currentContainer))),i=this.containers.length-1;0<=i;i--)e||s.push(n("deactivate",this,this.containers[i])),this.containers[i].containerCache.over&&(s.push(n("out",this,this.containers[i])),this.containers[i].containerCache.over=0);if(this._storedStylesheet&&(this._storedStylesheet.remove(),this._storedStylesheet=null),this._storedOpacity&&this.helper.css("opacity",this._storedOpacity),this._storedZIndex&&this.helper.css("zIndex","auto"===this._storedZIndex?"":this._storedZIndex),this.dragging=!1,e||this._trigger("beforeStop",t,this._uiHash()),this.placeholder[0].parentNode.removeChild(this.placeholder[0]),this.cancelHelperRemoval||(this.helper[0]!==this.currentItem[0]&&this.helper.remove(),this.helper=null),!e){for(i=0;i<s.length;i++)s[i].call(this,t);this._trigger("stop",t,this._uiHash())}return this.fromOutside=!1,!this.cancelHelperRemoval},_trigger:function(){!1===V.Widget.prototype._trigger.apply(this,arguments)&&this.cancel()},_uiHash:function(t){var e=t||this;return{helper:e.helper,placeholder:e.placeholder||V([]),position:e.position,originalPosition:e.originalPosition,offset:e.positionAbs,item:e.currentItem,sender:t?t.element:null}}});function O(e){return function(){var t=this.element.val();e.apply(this,arguments),this._refresh(),t!==this.element.val()&&this._trigger("change")}}V.widget("ui.spinner",{version:"1.14.1",defaultElement:"<input>",widgetEventPrefix:"spin",options:{classes:{"ui-spinner":"ui-corner-all","ui-spinner-down":"ui-corner-br","ui-spinner-up":"ui-corner-tr"},culture:null,icons:{down:"ui-icon-triangle-1-s",up:"ui-icon-triangle-1-n"},incremental:!0,max:null,min:null,numberFormat:null,page:10,step:1,change:null,spin:null,start:null,stop:null},_create:function(){this._setOption("max",this.options.max),this._setOption("min",this.options.min),this._setOption("step",this.options.step),""!==this.value()&&this._value(this.element.val(),!0),this._draw(),this._on(this._events),this._refresh(),this._on(this.window,{beforeunload:function(){this.element.removeAttr("autocomplete")}})},_getCreateOptions:function(){var s=this._super(),n=this.element;return V.each(["min","max","step"],function(t,e){var i=n.attr(e);null!=i&&i.length&&(s[e]=i)}),s},_events:{keydown:function(t){this._start(t)&&this._keydown(t)&&t.preventDefault()},keyup:"_stop",focus:function(){this.previous=this.element.val()},blur:function(t){this._stop(),this._refresh(),this.previous!==this.element.val()&&this._trigger("change",t)},mousewheel:function(t,e){var i=this.document[0].activeElement;if(this.element[0]===i&&e){if(!this.spinning&&!this._start(t))return!1;this._spin((0<e?1:-1)*this.options.step,t),clearTimeout(this.mousewheelTimer),this.mousewheelTimer=this._delay(function(){this.spinning&&this._stop(t)},100),t.preventDefault()}},"mousedown .ui-spinner-button":function(t){var e;e=this.element[0]===this.document[0].activeElement?this.previous:this.element.val(),t.preventDefault(),function(){this.element[0]!==this.document[0].activeElement&&(this.element.trigger("focus"),this.previous=e)}.call(this),!1!==this._start(t)&&this._repeat(null,V(t.currentTarget).hasClass("ui-spinner-up")?1:-1,t)},"mouseup .ui-spinner-button":"_stop","mouseenter .ui-spinner-button":function(t){if(V(t.currentTarget).hasClass("ui-state-active"))return!1!==this._start(t)&&void this._repeat(null,V(t.currentTarget).hasClass("ui-spinner-up")?1:-1,t)},"mouseleave .ui-spinner-button":"_stop"},_enhance:function(){this.uiSpinner=this.element.attr("autocomplete","off").wrap("<span>").parent().append("<a></a><a></a>")},_draw:function(){this._enhance(),this._addClass(this.uiSpinner,"ui-spinner","ui-widget ui-widget-content"),this._addClass("ui-spinner-input"),this.element.attr("role","spinbutton"),this.buttons=this.uiSpinner.children("a").attr("tabIndex",-1).attr("aria-hidden",!0).button({classes:{"ui-button":""}}),this._removeClass(this.buttons,"ui-corner-all"),this._addClass(this.buttons.first(),"ui-spinner-button ui-spinner-up"),this._addClass(this.buttons.last(),"ui-spinner-button ui-spinner-down"),this.buttons.first().button({icon:this.options.icons.up,showLabel:!1}),this.buttons.last().button({icon:this.options.icons.down,showLabel:!1}),this.buttons.height()>Math.ceil(.5*this.uiSpinner.height())&&0<this.uiSpinner.height()&&this.uiSpinner.height(this.uiSpinner.height())},_keydown:function(t){var e=this.options,i=V.ui.keyCode;switch(t.keyCode){case i.UP:return this._repeat(null,1,t),!0;case i.DOWN:return this._repeat(null,-1,t),!0;case i.PAGE_UP:return this._repeat(null,e.page,t),!0;case i.PAGE_DOWN:return this._repeat(null,-e.page,t),!0}return!1},_start:function(t){return!(!this.spinning&&!1===this._trigger("start",t))&&(this.counter||(this.counter=1),this.spinning=!0)},_repeat:function(t,e,i){t=t||500,clearTimeout(this.timer),this.timer=this._delay(function(){this._repeat(40,e,i)},t),this._spin(e*this.options.step,i)},_spin:function(t,e){var i=this.value()||0;this.counter||(this.counter=1),i=this._adjustValue(i+t*this._increment(this.counter)),this.spinning&&!1===this._trigger("spin",e,{value:i})||(this._value(i),this.counter++)},_increment:function(t){var e=this.options.incremental;return e?"function"==typeof e?e(t):Math.floor(t*t*t/5e4-t*t/500+17*t/200+1):1},_precision:function(){var t=this._precisionOf(this.options.step);return t=null!==this.options.min?Math.max(t,this._precisionOf(this.options.min)):t},_precisionOf:function(t){var t=t.toString(),e=t.indexOf(".");return-1===e?0:t.length-e-1},_adjustValue:function(t){var e=this.options,i=null!==e.min?e.min:0,s=t-i;return t=i+Math.round(s/e.step)*e.step,t=parseFloat(t.toFixed(this._precision())),null!==e.max&&t>e.max?e.max:null!==e.min&&t<e.min?e.min:t},_stop:function(t){this.spinning&&(clearTimeout(this.timer),clearTimeout(this.mousewheelTimer),this.counter=0,this.spinning=!1,this._trigger("stop",t))},_setOption:function(t,e){var i;"culture"===t||"numberFormat"===t?(i=this._parse(this.element.val()),this.options[t]=e,this.element.val(this._format(i))):("max"!==t&&"min"!==t&&"step"!==t||"string"==typeof e&&(e=this._parse(e)),"icons"===t&&(i=this.buttons.first().find(".ui-icon"),this._removeClass(i,null,this.options.icons.up),this._addClass(i,null,e.up),i=this.buttons.last().find(".ui-icon"),this._removeClass(i,null,this.options.icons.down),this._addClass(i,null,e.down)),this._super(t,e))},_setOptionDisabled:function(t){this._super(t),this._toggleClass(this.uiSpinner,null,"ui-state-disabled",!!t),this.element.prop("disabled",!!t),this.buttons.button(t?"disable":"enable")},_setOptions:O(function(t){this._super(t)}),_parse:function(t){return""===(t="string"==typeof t&&""!==t?window.Globalize&&this.options.numberFormat?Globalize.parseFloat(t,10,this.options.culture):+t:t)||isNaN(t)?null:t},_format:function(t){return""===t?"":window.Globalize&&this.options.numberFormat?Globalize.format(t,this.options.numberFormat,this.options.culture):t},_refresh:function(){this.element.attr({"aria-valuemin":this.options.min,"aria-valuemax":this.options.max,"aria-valuenow":this._parse(this.element.val())})},isValid:function(){var t=this.value();return null!==t&&t===this._adjustValue(t)},_value:function(t,e){var i;""!==t&&null!==(i=this._parse(t))&&(e||(i=this._adjustValue(i)),t=this._format(i)),this.element.val(t),this._refresh()},_destroy:function(){this.element.prop("disabled",!1).removeAttr("autocomplete role aria-valuemin aria-valuemax aria-valuenow"),this.uiSpinner.replaceWith(this.element)},stepUp:O(function(t){this._stepUp(t)}),_stepUp:function(t){this._start()&&(this._spin((t||1)*this.options.step),this._stop())},stepDown:O(function(t){this._stepDown(t)}),_stepDown:function(t){this._start()&&(this._spin((t||1)*-this.options.step),this._stop())},pageUp:O(function(t){this._stepUp((t||1)*this.options.page)}),pageDown:O(function(t){this._stepDown((t||1)*this.options.page)}),value:function(t){if(!arguments.length)return this._parse(this.element.val());O(this._value).call(this,t)},widget:function(){return this.uiSpinner}}),!0===V.uiBackCompat&&V.widget("ui.spinner",V.ui.spinner,{_enhance:function(){this.uiSpinner=this.element.attr("autocomplete","off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml())},_uiSpinnerHtml:function(){return"<span>"},_buttonHtml:function(){return"<a></a><a></a>"}});var A;V.ui.spinner,V.widget("ui.tabs",{version:"1.14.1",delay:300,options:{active:null,classes:{"ui-tabs":"ui-corner-all","ui-tabs-nav":"ui-corner-all","ui-tabs-panel":"ui-corner-bottom","ui-tabs-tab":"ui-corner-top"},collapsible:!1,event:"click",heightStyle:"content",hide:null,show:null,activate:null,beforeActivate:null,beforeLoad:null,load:null},_isLocal:(A=/#.*$/,function(t){var e=t.href.replace(A,""),i=location.href.replace(A,"");try{e=decodeURIComponent(e)}catch(t){}try{i=decodeURIComponent(i)}catch(t){}return 1<t.hash.length&&e===i}),_create:function(){var e=this,t=this.options;this.running=!1,this._addClass("ui-tabs","ui-widget ui-widget-content"),this._toggleClass("ui-tabs-collapsible",null,t.collapsible),this._processTabs(),t.active=this._initialActive(),Array.isArray(t.disabled)&&(t.disabled=V.uniqueSort(t.disabled.concat(V.map(this.tabs.filter(".ui-state-disabled"),function(t){return e.tabs.index(t)}))).sort()),!1!==this.options.active&&this.anchors.length?this.active=this._findActive(t.active):this.active=V(),this._refresh(),this.active.length&&this.load(t.active)},_initialActive:function(){var i=this.options.active,t=this.options.collapsible,s=decodeURIComponent(location.hash.substring(1));return null===i&&(s&&this.tabs.each(function(t,e){if(V(e).attr("aria-controls")===s)return i=t,!1}),null!==(i=null===i?this.tabs.index(this.tabs.filter(".ui-tabs-active")):i)&&-1!==i||(i=!!this.tabs.length&&0)),!1!==i&&-1===(i=this.tabs.index(this.tabs.eq(i)))&&(i=!t&&0),i=!t&&!1===i&&this.anchors.length?0:i},_getCreateEventData:function(){return{tab:this.active,panel:this.active.length?this._getPanelForTab(this.active):V()}},_tabKeydown:function(t){var e=V(this.document[0].activeElement).closest("li"),i=this.tabs.index(e),s=!0;if(!this._handlePageNav(t)){switch(t.keyCode){case V.ui.keyCode.RIGHT:case V.ui.keyCode.DOWN:i++;break;case V.ui.keyCode.UP:case V.ui.keyCode.LEFT:s=!1,i--;break;case V.ui.keyCode.END:i=this.anchors.length-1;break;case V.ui.keyCode.HOME:i=0;break;case V.ui.keyCode.SPACE:return t.preventDefault(),clearTimeout(this.activating),void this._activate(i);case V.ui.keyCode.ENTER:return t.preventDefault(),clearTimeout(this.activating),void this._activate(i!==this.options.active&&i);default:return}t.preventDefault(),clearTimeout(this.activating),i=this._focusNextTab(i,s),t.ctrlKey||t.metaKey||(e.attr("aria-selected","false"),this.tabs.eq(i).attr("aria-selected","true"),this.activating=this._delay(function(){this.option("active",i)},this.delay))}},_panelKeydown:function(t){this._handlePageNav(t)||t.ctrlKey&&t.keyCode===V.ui.keyCode.UP&&(t.preventDefault(),this.active.trigger("focus"))},_handlePageNav:function(t){return t.altKey&&t.keyCode===V.ui.keyCode.PAGE_UP?(this._activate(this._focusNextTab(this.options.active-1,!1)),!0):t.altKey&&t.keyCode===V.ui.keyCode.PAGE_DOWN?(this._activate(this._focusNextTab(this.options.active+1,!0)),!0):void 0},_findNextTab:function(t,e){var i=this.tabs.length-1;for(;-1!==V.inArray(t=(t=i<t?0:t)<0?i:t,this.options.disabled);)t=e?t+1:t-1;return t},_focusNextTab:function(t,e){return t=this._findNextTab(t,e),this.tabs.eq(t).trigger("focus"),t},_setOption:function(t,e){"active"===t?this._activate(e):(this._super(t,e),"collapsible"===t&&(this._toggleClass("ui-tabs-collapsible",null,e),e||!1!==this.options.active||this._activate(0)),"event"===t&&this._setupEvents(e),"heightStyle"===t&&this._setupHeightStyle(e))},refresh:function(){var t=this.options,e=this.tablist.children(":has(a[href])");t.disabled=V.map(e.filter(".ui-state-disabled"),function(t){return e.index(t)}),this._processTabs(),!1!==t.active&&this.anchors.length?this.active.length&&!V.contains(this.tablist[0],this.active[0])?this.tabs.length===t.disabled.length?(t.active=!1,this.active=V()):this._activate(this._findNextTab(Math.max(0,t.active-1),!1)):t.active=this.tabs.index(this.active):(t.active=!1,this.active=V()),this._refresh()},_refresh:function(){this._setOptionDisabled(this.options.disabled),this._setupEvents(this.options.event),this._setupHeightStyle(this.options.heightStyle),this.tabs.not(this.active).attr({"aria-selected":"false","aria-expanded":"false",tabIndex:-1}),this.panels.not(this._getPanelForTab(this.active)).hide().attr({"aria-hidden":"true"}),this.active.length?(this.active.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0}),this._addClass(this.active,"ui-tabs-active","ui-state-active"),this._getPanelForTab(this.active).show().attr({"aria-hidden":"false"})):this.tabs.eq(0).attr("tabIndex",0)},_processTabs:function(){var r=this,t=this.tabs,e=this.anchors,i=this.panels;this.tablist=this._getList().attr("role","tablist"),this._addClass(this.tablist,"ui-tabs-nav","ui-helper-reset ui-helper-clearfix ui-widget-header"),this.tablist.on("mousedown"+this.eventNamespace,"> li",function(t){V(this).is(".ui-state-disabled")&&t.preventDefault()}),this.tabs=this.tablist.find("> li:has(a[href])").attr({role:"tab",tabIndex:-1}),this._addClass(this.tabs,"ui-tabs-tab","ui-state-default"),this.anchors=this.tabs.map(function(){return V("a",this)[0]}).attr({tabIndex:-1}),this._addClass(this.anchors,"ui-tabs-anchor"),this.panels=V(),this.anchors.each(function(t,e){var i,s,n=V(e).uniqueId().attr("id"),o=V(e).closest("li"),a=o.attr("aria-controls");r._isLocal(e)?(s=decodeURIComponent(e.hash).substring(1),i=r.element.find("#"+CSS.escape(s))):(s=o.attr("aria-controls")||V({}).uniqueId()[0].id,(i=r.element.find("#"+s)).length||(i=r._createPanel(s)).insertAfter(r.panels[t-1]||r.tablist),i.attr("aria-live","polite")),i.length&&(r.panels=r.panels.add(i)),a&&o.data("ui-tabs-aria-controls",a),o.attr({"aria-controls":s,"aria-labelledby":n}),i.attr("aria-labelledby",n)}),this.panels.attr("role","tabpanel"),this._addClass(this.panels,"ui-tabs-panel","ui-widget-content"),t&&(this._off(t.not(this.tabs)),this._off(e.not(this.anchors)),this._off(i.not(this.panels)))},_getList:function(){return this.tablist||this.element.find("ol, ul").eq(0)},_createPanel:function(t){return V("<div>").attr("id",t).data("ui-tabs-destroy",!0)},_setOptionDisabled:function(t){var e,i;for(Array.isArray(t)&&(t.length?t.length===this.anchors.length&&(t=!0):t=!1),i=0;e=this.tabs[i];i++)e=V(e),!0===t||-1!==V.inArray(i,t)?(e.attr("aria-disabled","true"),this._addClass(e,null,"ui-state-disabled")):(e.removeAttr("aria-disabled"),this._removeClass(e,null,"ui-state-disabled"));this.options.disabled=t,this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,!0===t)},_setupEvents:function(t){var i={};t&&V.each(t.split(" "),function(t,e){i[e]="_eventHandler"}),this._off(this.anchors.add(this.tabs).add(this.panels)),this._on(!0,this.anchors,{click:function(t){t.preventDefault()}}),this._on(this.anchors,i),this._on(this.tabs,{keydown:"_tabKeydown"}),this._on(this.panels,{keydown:"_panelKeydown"}),this._focusable(this.tabs),this._hoverable(this.tabs)},_setupHeightStyle:function(t){var i,e=this.element.parent();"fill"===t?(i=e.height(),i-=this.element.outerHeight()-this.element.height(),this.element.siblings(":visible").each(function(){var t=V(this),e=t.css("position");"absolute"!==e&&"fixed"!==e&&(i-=t.outerHeight(!0))}),this.element.children().not(this.panels).each(function(){i-=V(this).outerHeight(!0)}),this.panels.each(function(){V(this).height(Math.max(0,i-V(this).innerHeight()+V(this).height()))}).css("overflow","auto")):"auto"===t&&(i=0,this.panels.each(function(){i=Math.max(i,V(this).height("").height())}).height(i))},_eventHandler:function(t){var e=this.options,i=this.active,s=V(t.currentTarget).closest("li"),n=s[0]===i[0],o=n&&e.collapsible,a=o?V():this._getPanelForTab(s),r=i.length?this._getPanelForTab(i):V(),i={oldTab:i,oldPanel:r,newTab:o?V():s,newPanel:a};t.preventDefault(),s.hasClass("ui-state-disabled")||s.hasClass("ui-tabs-loading")||this.running||n&&!e.collapsible||!1===this._trigger("beforeActivate",t,i)||(e.active=!o&&this.tabs.index(s),this.active=n?V():s,this.xhr&&this.xhr.abort(),r.length||a.length||V.error("jQuery UI Tabs: Mismatching fragment identifier."),a.length&&this.load(this.tabs.index(s),t),this._toggle(t,i))},_toggle:function(t,e){var i=this,s=e.newPanel,n=e.oldPanel;function o(){i.running=!1,i._trigger("activate",t,e)}function a(){i._addClass(e.newTab.closest("li"),"ui-tabs-active","ui-state-active"),s.length&&i.options.show?i._show(s,i.options.show,o):(s.show(),o())}this.running=!0,n.length&&this.options.hide?this._hide(n,this.options.hide,function(){i._removeClass(e.oldTab.closest("li"),"ui-tabs-active","ui-state-active"),a()}):(this._removeClass(e.oldTab.closest("li"),"ui-tabs-active","ui-state-active"),n.hide(),a()),n.attr("aria-hidden","true"),e.oldTab.attr({"aria-selected":"false","aria-expanded":"false"}),s.length&&n.length?e.oldTab.attr("tabIndex",-1):s.length&&this.tabs.filter(function(){return 0===V(this).attr("tabIndex")}).attr("tabIndex",-1),s.attr("aria-hidden","false"),e.newTab.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0})},_activate:function(t){var t=this._findActive(t);t[0]!==this.active[0]&&(t=(t=t.length?t:this.active).find(".ui-tabs-anchor")[0],this._eventHandler({target:t,currentTarget:t,preventDefault:V.noop}))},_findActive:function(t){return!1===t?V():this.tabs.eq(t)},_getIndex:function(t){return t="string"==typeof t?this.anchors.index(this.anchors.filter("[href$='"+CSS.escape(t)+"']")):t},_destroy:function(){this.xhr&&this.xhr.abort(),this.tablist.removeAttr("role").off(this.eventNamespace),this.anchors.removeAttr("role tabIndex").removeUniqueId(),this.tabs.add(this.panels).each(function(){V.data(this,"ui-tabs-destroy")?V(this).remove():V(this).removeAttr("role tabIndex aria-live aria-busy aria-selected aria-labelledby aria-hidden aria-expanded")}),this.tabs.each(function(){var t=V(this),e=t.data("ui-tabs-aria-controls");e?t.attr("aria-controls",e).removeData("ui-tabs-aria-controls"):t.removeAttr("aria-controls")}),this.panels.show(),"content"!==this.options.heightStyle&&this.panels.css("height","")},enable:function(i){var t=this.options.disabled;!1!==t&&(t=void 0!==i&&(i=this._getIndex(i),Array.isArray(t)?V.map(t,function(t){return t!==i?t:null}):V.map(this.tabs,function(t,e){return e!==i?e:null})),this._setOptionDisabled(t))},disable:function(t){var e=this.options.disabled;if(!0!==e){if(void 0===t)e=!0;else{if(t=this._getIndex(t),-1!==V.inArray(t,e))return;e=Array.isArray(e)?V.merge([t],e).sort():[t]}this._setOptionDisabled(e)}},load:function(t,s){t=this._getIndex(t);function n(t,e){"abort"===e&&o.panels.stop(!1,!0),o._removeClass(i,"ui-tabs-loading"),a.removeAttr("aria-busy"),t===o.xhr&&delete o.xhr}var o=this,i=this.tabs.eq(t),t=i.find(".ui-tabs-anchor"),a=this._getPanelForTab(i),r={tab:i,panel:a};this._isLocal(t[0])||(this.xhr=V.ajax(this._ajaxSettings(t,s,r)),"canceled"!==this.xhr.statusText&&(this._addClass(i,"ui-tabs-loading"),a.attr("aria-busy","true"),this.xhr.done(function(t,e,i){a.html(t),o._trigger("load",s,r),n(i,e)}).fail(function(t,e){n(t,e)})))},_ajaxSettings:function(t,i,s){var n=this;return{url:t.attr("href"),beforeSend:function(t,e){return n._trigger("beforeLoad",i,V.extend({jqXHR:t,ajaxSettings:e},s))}}},_getPanelForTab:function(t){t=V(t).attr("aria-controls");return this.element.find("#"+CSS.escape(t))}}),!0===V.uiBackCompat&&V.widget("ui.tabs",V.ui.tabs,{_processTabs:function(){this._superApply(arguments),this._addClass(this.tabs,"ui-tab")}}),V.ui.tabs,V.widget("ui.tooltip",{version:"1.14.1",options:{classes:{"ui-tooltip":"ui-corner-all ui-widget-shadow"},content:function(){var t=V(this).attr("title");return V("<a>").text(t).html()},hide:!0,items:"[title]:not([disabled])",position:{my:"left top+15",at:"left bottom",collision:"flipfit flip"},show:!0,track:!1,close:null,open:null},_addDescribedBy:function(t,e){var i=(t.attr("aria-describedby")||"").split(/\s+/);i.push(e),t.data("ui-tooltip-id",e).attr("aria-describedby",String.prototype.trim.call(i.join(" ")))},_removeDescribedBy:function(t){var e=t.data("ui-tooltip-id"),i=(t.attr("aria-describedby")||"").split(/\s+/),e=V.inArray(e,i);-1!==e&&i.splice(e,1),t.removeData("ui-tooltip-id"),(i=String.prototype.trim.call(i.join(" ")))?t.attr("aria-describedby",i):t.removeAttr("aria-describedby")},_create:function(){this._on({mouseover:"open",focusin:"open"}),this.tooltips={},this.parents={},this.liveRegion=V("<div>").attr({role:"log","aria-live":"assertive","aria-relevant":"additions"}).appendTo(this.document[0].body),this._addClass(this.liveRegion,null,"ui-helper-hidden-accessible"),this.disabledTitles=V([])},_setOption:function(t,e){var i=this;this._super(t,e),"content"===t&&V.each(this.tooltips,function(t,e){i._updateContent(e.element)})},_setOptionDisabled:function(t){this[t?"_disable":"_enable"]()},_disable:function(){var s=this;V.each(this.tooltips,function(t,e){var i=V.Event("blur");i.target=i.currentTarget=e.element[0],s.close(i,!0)}),this.disabledTitles=this.disabledTitles.add(this.element.find(this.options.items).addBack().filter(function(){var t=V(this);if(t.is("[title]"))return t.data("ui-tooltip-title",t.attr("title")).removeAttr("title")}))},_enable:function(){this.disabledTitles.each(function(){var t=V(this);t.data("ui-tooltip-title")&&t.attr("title",t.data("ui-tooltip-title"))}),this.disabledTitles=V([])},open:function(t){var i=this,e=V(t?t.target:this.element).closest(this.options.items);e.length&&!e.data("ui-tooltip-id")&&(e.attr("title")&&e.data("ui-tooltip-title",e.attr("title")),e.data("ui-tooltip-open",!0),t&&"mouseover"===t.type&&e.parents().each(function(){var t,e=V(this);e.data("ui-tooltip-open")&&((t=V.Event("blur")).target=t.currentTarget=this,i.close(t,!0)),e.attr("title")&&(e.uniqueId(),i.parents[this.id]={element:this,title:e.attr("title")},e.attr("title",""))}),this._registerCloseHandlers(t,e),this._updateContent(e,t))},_updateContent:function(e,i){var t=this.options.content,s=this,n=i?i.type:null;if("string"==typeof t||t.nodeType||t.jquery)return this._open(i,e,t);(t=t.call(e[0],function(t){e.data("ui-tooltip-open")&&(i&&(i.type=n),s._open(i,e,t))}))&&this._open(i,e,t)},_open:function(t,e,i){var s,n,o,a=V.extend({},this.options.position);function r(t){a.of=t,s.is(":hidden")||s.position(a)}i&&((o=this._find(e))?o.tooltip.find(".ui-tooltip-content").html(i):(e.is("[title]")&&(t&&"mouseover"===t.type?e.attr("title",""):e.removeAttr("title")),o=this._tooltip(e),s=o.tooltip,this._addDescribedBy(e,s.attr("id")),s.find(".ui-tooltip-content").html(i),this.liveRegion.children().hide(),(o=V("<div>").html(s.find(".ui-tooltip-content").html())).removeAttr("name").find("[name]").removeAttr("name"),o.removeAttr("id").find("[id]").removeAttr("id"),o.appendTo(this.liveRegion),this.options.track&&t&&/^mouse/.test(t.type)?(this._on(this.document,{mousemove:r}),r(t)):s.position(V.extend({of:e},this.options.position)),s.hide(),this._show(s,this.options.show),this.options.track&&this.options.show&&this.options.show.delay&&(n=this.delayedShow=setInterval(function(){s.is(":visible")&&(r(a.of),clearInterval(n))},13)),this._trigger("open",t,{tooltip:s})))},_registerCloseHandlers:function(t,e){var i={keyup:function(t){t.keyCode===V.ui.keyCode.ESCAPE&&((t=V.Event(t)).currentTarget=e[0],this.close(t,!0))}};e[0]!==this.element[0]&&(i.remove=function(){var t=this._find(e);t&&this._removeTooltip(t.tooltip)}),t&&"mouseover"!==t.type||(i.mouseleave="close"),t&&"focusin"!==t.type||(i.focusout="close"),this._on(!0,e,i)},close:function(t){var e,i=this,s=V(t?t.currentTarget:this.element),n=this._find(s);n?(e=n.tooltip,n.closing||(clearInterval(this.delayedShow),s.data("ui-tooltip-title")&&!s.attr("title")&&s.attr("title",s.data("ui-tooltip-title")),this._removeDescribedBy(s),n.hiding=!0,e.stop(!0),this._hide(e,this.options.hide,function(){i._removeTooltip(V(this))}),s.removeData("ui-tooltip-open"),this._off(s,"mouseleave focusout keyup"),s[0]!==this.element[0]&&this._off(s,"remove"),this._off(this.document,"mousemove"),t&&"mouseleave"===t.type&&V.each(this.parents,function(t,e){V(e.element).attr("title",e.title),delete i.parents[t]}),n.closing=!0,this._trigger("close",t,{tooltip:e}),n.hiding)||(n.closing=!1)):s.removeData("ui-tooltip-open")},_tooltip:function(t){var e=V("<div>").attr("role","tooltip"),i=V("<div>").appendTo(e),s=e.uniqueId().attr("id");return this._addClass(i,"ui-tooltip-content"),this._addClass(e,"ui-tooltip","ui-widget ui-widget-content"),e.appendTo(this._appendTo(t)),this.tooltips[s]={element:t,tooltip:e}},_find:function(t){t=t.data("ui-tooltip-id");return t?this.tooltips[t]:null},_removeTooltip:function(t){clearInterval(this.delayedShow),t.remove(),delete this.tooltips[t.attr("id")]},_appendTo:function(t){t=t.closest(".ui-front, dialog");return t=t.length?t:this.document[0].body},_destroy:function(){var s=this;V.each(this.tooltips,function(t,e){var i=V.Event("blur"),e=e.element;i.target=i.currentTarget=e[0],s.close(i,!0),V("#"+t).remove(),e.data("ui-tooltip-title")&&(e.attr("title")||e.attr("title",e.data("ui-tooltip-title")),e.removeData("ui-tooltip-title"))}),this.liveRegion.remove()}}),!0===V.uiBackCompat&&V.widget("ui.tooltip",V.ui.tooltip,{options:{tooltipClass:null},_tooltip:function(){var t=this._superApply(arguments);return this.options.tooltipClass&&t.tooltip.addClass(this.options.tooltipClass),t}}),V.ui.tooltip});