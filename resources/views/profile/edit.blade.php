@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Biodata</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the errors below:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Biodata Form --}}
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Phone --}}
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <select name="title" class="form-control">
                <option value="">Select Title</option>
                @foreach(['Mr', 'Mrs', 'Miss', 'Dr'] as $title)
                    <option value="{{ $title }}" {{ old('title', $user->title) == $title ? 'selected' : '' }}>{{ $title }}</option>
                @endforeach
            </select>
        </div>

        {{-- ID/Passport --}}
        <div class="mb-3">
            <label for="id_passport" class="form-label">ID/Passport</label>
            <input type="text" name="id_passport" class="form-control" value="{{ old('id_passport', $user->id_passport) }}">
        </div>
{{-- KRA PIN --}}
<div class="mb-3">
    <label for="kra_pin" class="form-label">KRA PIN</label>
    <input type="text" name="kra_pin" id="kra_pin"
           class="form-control"
           value="{{ old('kra_pin', $user->kra_pin) }}"
           maxlength="12"
           pattern="[A-Za-z0-9]+"
           title="KRA PIN must be alphanumeric and no more than 12 characters.">
</div>


        {{-- County --}}
        <div class="mb-3">
            <label for="county" class="form-label">County</label>
            <select name="county" id="county" class="form-control" onchange="loadSubCounties()">
                <option value="">Select County</option>
                @php
                    $counties = [
                        "Mombasa", "Kwale", "Kilifi", "Tana River", "Lamu", "Taita-Taveta", "Garissa", "Wajir", "Mandera",
                        "Marsabit", "Isiolo", "Meru", "Tharaka-Nithi", "Embu", "Kitui", "Machakos", "Makueni", "Nyandarua",
                        "Nyeri", "Kirinyaga", "Murang'a", "Kiambu", "Turkana", "West Pokot", "Samburu", "Trans Nzoia",
                        "Uasin Gishu", "Elgeyo-Marakwet", "Nandi", "Baringo", "Laikipia", "Nakuru", "Narok", "Kajiado",
                        "Kericho", "Bomet", "Kakamega", "Vihiga", "Bungoma", "Busia", "Siaya", "Kisumu", "Homa Bay",
                        "Migori", "Kisii", "Nyamira", "Nairobi"
                    ];
                @endphp
                @foreach($counties as $county)
                    <option value="{{ $county }}" {{ old('county', $user->county) == $county ? 'selected' : '' }}>{{ $county }}</option>
                @endforeach
            </select>
        </div>

        
{{-- Sub-county --}}
<div class="mb-3">
    <label for="sub_county" class="form-label">Sub-County</label>
    <select name="sub_county" id="sub_county" class="form-control">
        <option value="">Select Sub-County</option>
        {{-- Sub-counties will be dynamically loaded via JS --}}
    </select>
</div>
{{-- Ward --}}
<div class="mb-3">
    <label for="ward" class="form-label">Ward</label>
    <select name="ward" id="ward" class="form-control">
        <option value="{{ $user->ward }}" selected>{{ $user->ward }}</option>

        {{-- Wards will be dynamically loaded --}}
    </select>
</div>

{{-- Ethnicity --}}
<div class="mb-3">
    <label for="ethnicity" class="form-label text-sm fw-medium text-dark">Ethnicity</label>
    <select name="ethnicity" id="ethnicity" class="form-select">
        <option value="" disabled selected>Select Ethnicity</option>
        <option value="Kikuyu">Kikuyu</option>
        <option value="Luhya">Luhya</option>
        <option value="Luo">Luo</option>
        <option value="Kalenjin">Kalenjin</option>
        <option value="Kamba">Kamba</option>    
        <option value="Somali">Somali</option>
        <option value="Kisii">Kisii</option>
        <option value="Mijikenda">Mijikenda</option>
        <option value="Meru">Meru</option>
        <option value="Turkana">Turkana</option>
        <option value="Maasai">Maasai</option>
        <option value="Embu">Embu</option>
        <option value="Taita">Taita</option>
        <option value="Taveta">Taveta</option>
        <option value="Samburu">Samburu</option>
        <option value="Pokot">Pokot</option>
        <option value="Boran">Boran</option>
        <option value="Rendille">Rendille</option>
        <option value="Swahili">Swahili</option>
        <option value="Other">Other</option>
    </select>
</div>

        {{-- Gender --}}
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-control">
                <option value="">Select Gender</option>
                @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $value => $label)
                    <option value="{{ $value }}" {{ old('gender', $user->gender) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Nationality --}}
        <div class="mb-3">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $user->nationality) }}">
        </div>

       

        {{-- Date of Birth --}}
<div class="mb-3">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" 
           name="dob" 
           id="dob"
           class="form-control @error('dob') is-invalid @enderror"
           max="2010-12-31"
           value="{{ old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}">
    
    @error('dob')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Disability Status --}}
<div class="mb-3">
    <label for="disability_status" class="form-label">Do you have a disability?</label>
    <select name="disability_status" id="disability_status" class="form-control">
        <option value="">Select Option</option>
        <option value="yes" {{ old('disability_status', $user->disability_status) == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ old('disability_status', $user->disability_status) == 'no' ? 'selected' : '' }}>No</option>
    </select>
</div>

{{-- Disability Certificate Number --}}
<div class="mb-3" id="certificateField" style="display: none;">
    <label for="disability_certificate_number" class="form-label">Disability Certificate Number</label>
    <input type="text"
           name="disability_certificate_number"
           id="disability_certificate_number"
           class="form-control"
           value="{{ old('disability_certificate_number', $user->disability_certificate_number) }}"
           placeholder="Enter certificate number if applicable"
           maxlength="12"
           pattern="[A-Za-z0-9]{1,12}"
           title="Maximum 12 alphanumeric characters only">
</div>






        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update Biodata</button>
    </form>
</div>
@endsection
<script>
    const countiesWithSubCounties = {
        "Mombasa": ["Changamwe", "Jomvu", "Kisauni", "Nyali", "Likoni", "Mvita"],
  "Kwale": ["Kinango", "Lunga Lunga", "Matuga", "Msambweni", "Kaloleni"],
  "Kilifi": ["Kilifi North", "Kilifi South", "Rabai", "Malindi", "Ganze", "Magarini"],
  "Tana River": ["Galole", "Garsen", "Bura"],
  "Lamu": ["Lamu East", "Lamu West"],
  "Taita-Taveta": ["Mwatate", "Voi", "Wundanyi"],
  "Garissa": ["Balambala", "Dadaab", "Fafi", "Garissa Township", "Ijara", "Lagdera"],
  "Wajir": ["Eldas", "Tarba", "Wajir East", "Wajir North", "Wajir South", "Wajir West", "Habaswein"],
  "Mandera": ["Banissa", "Mandera East", "Mandera North", "Mandera South", "Mandera West", "Lafey"],
  "Marsabit": ["North Horr", "Saku", "Laisamis", "Moyale"],
  "Isiolo": ["Isiolo North", "Isiolo South"],
  "Meru": ["Imenti North",'Imenti Central', "Imenti South", "Igembe Central", "Igembe North", "Igembe South", "Tigania East", "Tigania West"],
  "Tharaka-Nithi": ["Chuka", "Maara", "Tharaka"],
  "Embu": ["Runyenjes", "Manyatta", "Mbeere North", "Mbeere South"],
  "Kitui": ["Kitui Central", "Kitui East", "Kitui Rural", "Kitui South", "Kitui West", "Mwingi Central", "Mwingi North", "Mwingi West"],
  "Machakos": ["Machakos Town", "Mwala", "Yatta", "Mavoko", "Kangundo", "Kathiani", "Matungulu"],
  "Makueni": ["Kaiti", "Kilome", "Makueni", "Mbooni", "Kibwezi East", "Kibwezi West"],
  "Nyandarua": ["Kinangop", "Kipipiri", "Ndaragwa", "Ol Kalou", "Njabini"],
  "Nyeri": ["Tetu", "Mathira", "Kieni", "Othaya", "Nyeri Town"],
  "Kirinyaga": ["Gichugu", "Kirinyaga Central", "Kirinyaga East", "Mwea", "Ndia"],
  "Murang'a": ["Kiharu", "Kigumo", "Mathioya", "Kandara", "Maragwa", "Kigumo"],
  "Kiambu": ["Gatundu North", "Gatundu South", "Juja", "Kiambu", "Lari", "Thika East", "Thika West", "Ruiru", "Kabete", "Kiambaa"],
  "Turkana": ["Turkana Central", "Turkana East", "Turkana North", "Turkana South", "Turkana West", "Loima"],
  "West Pokot": ["Kacheliba", "Kapenguria", "Sigor", "Pokot South", "Tiaty"],
  "Samburu": ["Samburu East", "Samburu North", "Samburu West"],
  "Trans Nzoia": ["Cherangany", "Kwanza", "Saboti", "Endebess"],
  "Uasin Gishu": ["Eldoret East", "Eldoret West", "Soy", "Moiben", "Turbo"],
  "Elgeyo-Marakwet": ["Keiyo North", "Keiyo South", "Marakwet East", "Marakwet West"],
  "Nandi": ["Aldai", "Chesumei", "Emgwen", "Mosop", "Tinderet"],
  "Baringo": ["Baringo Central", "Baringo North", "Baringo South", "Mogotio", "Tiaty", "Eldama Ravine"],
  "Laikipia": ["Laikipia East", "Laikipia North", "Laikipia West"],
  "Nakuru": ["Nakuru Town East", "Nakuru Town West", "Gilgil", "Naivasha", "Molo", "Kuresoi North", "Kuresoi South", "Rongai", "Subukia", "Bahati", "Njoro"],
  "Narok": ["Narok East", "Narok North", "Narok South", "Emurua Dikirr", "Kilgoris", "Loita"],
  "Kajiado": ["Kajiado Central", "Kajiado North", "Kajiado South", "Kajiado East", "Kajiado West", "Ngong"],
  "Kericho": ["Bureti", "Ainamoi", "Kipkelion East", "Kipkelion West", "Sigowet-Soin"],
  "Bomet": ["Bomet Central", "Chepalungu", "Sotik","Konoin", "Bomet East"],
  "Kakamega": ["Lugari", "Likuyani", "Malava", "Matungu", "Butere", "Shinyalu", "Ikolomani", "Mumias East", "Mumias West", "Navakholo"],
  "Vihiga": ["Emuhaya", "Luanda", "Sabatia", "Vihiga", "Hamisi"],
  "Bungoma": ["Bungoma East", "Bungoma North", "Bungoma South", "Bungoma West", "Mt. Elgon", "Kimilili", "Webuye East", "Webuye West"],
  "Busia": ["Nambale", "Matayos", "Budalang'i", "Butula", "Funyula", "Teso North", "Teso South"],
  "Siaya": ["Gem", "Ugenya", "Rarieda", "Bondo", "Alego Usonga"],
  "Kisumu": ["Kisumu East", "Kisumu West", "Kisumu Central", "Seme", "Nyando", "Muhoroni", "Nyakach"],
  "Homa Bay": ["Homa Bay Town", "Ndhiwa", "Rachuonyo North", "Rachuonyo South", "Suba North", "Suba South", "Kabondo Kasipul"],
  "Migori": ["Suna East", "Suna West", "Rongo", "Awendo", "Nyatike", "Uriri", "Kuria West", "Kuria East"],
  "Kisii": ["Bonchari", "Kitutu Chache", "Nyaribari Chache", "Nyaribari Masaba", "South Mugirango", "Kitutu Masaba", "Marani"],
  "Nyamira": ["Borabu", "Nyamira", "West Mugirango"],
  "Nairobi": ["Westlands", "Kibra", "Lang'ata", "Dagoretti North","Dagoretti South", "Embakasi Central","Embakasi East", "Embakasi North", "Embakasi South","Embakasi West","Roysambu","Kasarani","Makadara", "Starehe", "Kamukunji","Mathare", "Ruaraka"]
}

    function loadSubCounties() {
        const county = document.getElementById("county").value;
        const subCountySelect = document.getElementById("sub_county");

        // Clear previous options
        subCountySelect.innerHTML = '<option value="">Select Sub-County</option>';

        if (county && countiesWithSubCounties[county]) {
            countiesWithSubCounties[county].forEach(sub => {
                const option = document.createElement("option");
                option.value = sub;
                option.text = sub;
                subCountySelect.appendChild(option);
            });
        }
    }

    // Prepopulate sub-counties if editing
    document.addEventListener("DOMContentLoaded", () => {
        const selectedCounty = document.getElementById("county").value;
        const selectedSubCounty = @json(old('sub_county', $user->sub_county));
        if (selectedCounty) {
            loadSubCounties();
            setTimeout(() => {
                document.getElementById("sub_county").value = selectedSubCounty;
            }, 100);
        }
    });
</script>

<script>
  // Mapping sub-counties to wards
  const subCountyToWards = {
    "Kibra": ["Laini Saba", "Lindi", "Makina", "Woodley/Kenyatta Golf Course", "Sarang'ombe"],
    "Lang'ata": ["Karen", "Nairobi West", "Mugumo‑ini", "South C", "Nyayo Highrise"],
    "Dagoretti North": ["Kilimani", "Kawangware", "Gatina", "Kileleshwa", "Kabiro"],
    "Dagoretti South": ["Mutu‑ini", "Ngand'o", "Riruta", "Uthiru/Ruthimitu", "Waithaka"],
    "Embakasi Central": ["Kayole North", "Kayole Central", "Kayole South", "Komarock", "Matopeni/Spring Valley"],
    "Embakasi East": ["Upper Savanna", "Lower Savanna", "Embakasi", "Utawala", "Mihang'o"],
    "Embakasi North": ["Kariobangi North", "Dandora Area I", "Dandora Area II", "Dandora Area III", "Dandora Area IV"],
    "Embakasi South": ["Imara Daima", "Kwa Njenga", "Kwa Reuben", "Pipeline", "Kware"],
    "Embakasi West": ["Umoja I", "Umoja II", "Mowlem", "Kariobangi South"],
    "Roysambu": ["Roysambu", "Zimmerman", "Githurai", "Kahawa", "Kahawa West"],
    "Kasarani": ["Clay City", "Mwiki", "Kasarani", "Njiru", "Ruai"],
    "Ruaraka": ["Babadogo", "Utalii", "Mathare North", "Lucky Summer", "Korogocho"],
    "Makadara": ["Makongeni", "Maringo/Hamza", "Harambee", "Viwandani"],
    "Kamukunji": ["Pumwani", "Eastleigh North", "Eastleigh South", "Airbase", "California"],
    "Starehe": ["Nairobi Central", "Ngara", "Pangani", "Ziwani/Kariokor", "Nairobi South"],
    "Mathare": ["Hospital", "Mabatini", "Huruma", "Ngei", "Mlango Kubwa", "Kiamaiko"],
    "Westlands": ["Kitisuru", "Parklands/Highridge", "Karura", "Kangemi", "Mountain View"],
    "Samburu West": ["Lodokejek", "Suguta Marmar", "Maralal", "Poro"],
    "Narok North": ["Olpusimoru", "Olokurto", "Narok Town", "Nkareta", "Olorropil", "Melili"],
    "Belgut": ["Waldai", "Kabianga", "Cheptororiet", "Chaik", "Kapsuser"],
    "Bureti": ["Kisiara", "Tebesonik", "Cheboin", "Chemosot", "Litein", "Cheplanget", "Kapkatet"],
    "Kipkelion East": ["Londiani", "Kedowa/Kimugul", "Chepseon", "Tendeno"],
    "Kipkelion West": ["Kipkelion", "Chilchila", "Kamasian", "Kunyak"],
    "Kericho East": ["Kapsoit", "Ainamoi", "Kapkugerwet", "Kipchebor", "Kipchimchim", "Kapsaos"],
    "Sigowet–Soin": ["Sigowet", "Kaplelartet", "Soliat", "Soin"],
    "Bomet Central": ["Mutarakwa", "Silibwet Township", "Singorwet", "Chesoen", "Ndaraweta"],
    "Bomet East": ["Longisa", "Kembu", "Chemaner", "Merigi", "Kipkeres"],
    "Chepalungu": ["Sigor", "Kongasis", "Chebunyo", "Nyongores", "Siongiroi"],
    "Konoin": ["Kimulot", "Mogogosiek", "Boito", "Embomos", "Chepchabas"],
    "Sotik": ["Ndanai/Abosi", "Kipsonoi", "Kapletundo", "Chemagel", "Manaret/Rongena"],
"Kisii Central": ["Keumbu", "Kiogoro", "Birongo", "Ibeno"],
"Kitutu Chache North": ["Sensi", "Marani", "Kegogi", "Kiamokama"],
"Kitutu Chache South": ["Bogusero", "Bogeka", "Nyakoe", "Kitutu Central", "Nyatieko"],
"Bonchari": ["Riana", "Bomorenda", "Bomariba", "Bogiakumu"],
"South Mugirango": ["Tabaka", "Boikang’a", "Bogetenga", "Moticho", "Getenga"],
"Bobasi": ["Masige East", "Masige West", "Bobasi Central", "Nyacheki", "Sameta/Mokwerero", "Boochi/Tendere"],
"Bomachoge Borabu": ["Boochi Borabu", "Bombaba Borabu", "Magenche", "Borabu Chache"],
"Bomachoge Chache": ["Majoge Basi", "Boochi/Tendere", "Bosoti/Sengera", "Tabaka"],
"Nyaribari Chache": ["Bobaracho", "Kiogoro", "Birongo", "Ibeno"],
"Nyaribari Masaba": ["Ichuni", "Nyamasibi", "Masimba", "Rigoma", "Gionsia"],  // Some wards overlap, ensure you dedupe if needed
// Mombasa County
"Mvita": ["Tudor", "Tononoka", "Shimanzi/Ganjoni", "Majengo", "Ganjoni"],
"Kisauni": ["Mjambere", "Junda", "Bamburi", "Mwakirunge", "Mtopanga", "Magogoni", "Shanzu"],
"Nyali": ["Frere Town", "Ziwa la Ng’ombe", "Mkomani", "Kongowea", "Kadzandani"],
"Changamwe": ["Changamwe", "Chaani", "Airport", "Kipevu", "Port Reitz"],
"Jomvu": ["Jomvu Kuu", "Miritini", "Mikindani"],
"Likoni": ["Mtongwe", "Shika Adabu", "Bofu", "Likoni", "Timbwani"],
// Kiambu County
  "Gatundu North": ["Gituamba","Githobokoni","Chania","Mang’u"],
  "Gatundu South": ["Kiamwangi","Kiganjo","Ndarugo","Ngenda"],
  "Juja": ["Murera","Theta","Juja","Witeithie","Kalimoni"],
  "Thika Town": ["Township","Kamenu","Hospital","Gatuanyaga","Ngoliba"],
  "Ruiru": ["Gitothua","Biashara","Gatongora","Kahawa/Sukari","Kahawa Wendani","Kiuu","Mwiki","Mwihoko"],
  "Githunguri": ["Githunguri","Githiga","Ikinu","Ngewa","Komothai"],
  "Kiambu": ["Ting’ang’a","Ndumberi","Riabai","Township"],
  "Kiambaa": ["Cianda","Karuri","Ndenderu","Muchatha","Kihara"],
  "Kikuyu": ["Karai","Nachu","Sigona","Kikuyu","Kinoo"],
  "Kabete": ["Gitaru","Muguga","Nyathuna","Kabete","Uthiru"],
  "Limuru": ["Bibirioni","Limuru Central","Ndeiya","Limuru East","Ngecha/Tigoni"],
  "Lari": ["Kinale","Kijabe","Nyanduma","Kamburu","Lari/Kirenga"],

  // Kirinyaga County
  "Kirinyaga Central": ["Kerugoya Central","Kerugoya North","Nduini","Inoi","Kanyeki‑ine","Kerugoya South","Muruana","Mutira"],
  "Mwea East": ["Kangai","Murinduko","Mutithi","Nyangati","Tebere","Thiba","Kinyaga","Kutus South"],
  "Mwea West": ["Wamumu","Kahawa","Gichugu","Ndia North","Ndia South"], // example
  "Gichugu": ["Gichugu South","Gichugu North"], // example
  "Ndia": ["Gacharu","Karima","Kathaka","Kariti","Kiine","Mukure","Mwerua"],

  // Meru County
  "Imenti North": ["Buuri","Nchiru","Hill Girls","Ntonyiri","Kibirichia"],
  "Imenti South": ["Kanuni","Kibirichia","Kiagu","Ntonyiri South"],
  "Igembe North": ["Adu","Aujara","Kanuni","Tharaka"],
  "Igembe Central": ["Maua","Athiru Gaiti","Akachiu"],
  "Igembe South": ["Ntonyiri","Karama","Kaunguni"],
  "Meru South": ["Michae","Nkuene","Nkubu","Athurine","Mugwe","Meru Town West","Meru Town East"],

  // Machakos County
  "Mavoko": ["Mlango Kubwa","Masii","Athi River","Syokimau/Mulolongo","Kinanie"],
  "Machakos Town": ["Muvuti","Kola","Machakos Town","Kangundo Road","Salama"],
  "Yatta": ["Katoloni","Kitoloni","Ngewa","Matungulu","Matuu"],
  "Kangundo": ["Kangundo North","Kangundo South","Mumoni","Kalama","Tala"],
  "Kathiani": ["Kamunyolo","Mbeti North","Mbitini","Mitaboni","Kathiani"],
  "Kangundo": ["same as above, ensure unique"],
  // add more if needed...

  // Nakuru County
  "Nakuru East": ["Biashara","Mwariki","Shaabab","Menengai"],
  "Nakuru West": ["Flamingo","Elburgon","Kaptembwo","Kapkures"],
  "Nakuru Town East": ["Nakitari","Baruti","Kaptembwo East"],
  "Nakuru Town West": ["Kamukunji","Kahawa","Kaptembwo West"],
  "Naivasha": ["Naivasha Town","Kiamaina","Karagita","Tigoni","Elmenteita"],
  "Gilgil": ["Gilgil Town","Mbogoini","Ndabibi"],
  "Subukia": ["Kabazi","Munyu","Ngata","Kabazi East"],
  // etc...

  // Kajiado County
  "Kajiado North": ["Ngong","Ololua","Mosiro","Ewuaso O Nkidong’i"],
  "Kajiado East": ["Kitengela","Rombo","Lewa","Ongata Rongai"],
  "Kajiado West": ["Isinya","Kiserian","Ongata Rongai West"],
  "Kajiado South": ["Isinya South","Entonet","Iloodokilani","Mashuuru"],
  "Magadi": ["Magadi Town","Mbirikani","Tuala"],
  "Loitokitok": ["Loitokitok","Kimana","Isinya East"],
  // Uasin Gishu
"Soy": ["Ziwa", "Kapseret", "Segero/Barsombe", "Moi’s Bridge", "Kapsaos", "Kiplombe"],
"Turbo": ["Tapsagoi", "Kamagut", "Kamagut", "Kiplombe", "Huruma", "Kimumu"],
"Moiben": ["Karuna/Meibeki", "Sergoit", "Moiben", "Tembelio", "Kimumu"],
"Ainabkoi": ["Kapsoya", "Ainabkoi/Olare", "Kaptagat"],
"Kesses": ["Racecourse", "Cheptiret/Kipchamo", "Tarakwa"],
"Kapseret": ["Simat/Kapseret", "Langas", "Megun", "Ngeria"],
"Langas": ["Langas"],

// Elgeyo-Marakwet
"Keiyo North": ["Tambach", "Emsoo", "Kapchemutwa", "Kamariny"],
"Keiyo South": ["Metkei", "Kabiemit", "Soy North", "Soy South"],
"Marakwet East": ["Kapyego", "Endo", "Embobut/Embolot"],
"Marakwet West": ["Lelan", "Sengwer", "Cherang’any/Chebororwa", "Moiben/Kuserwo"],

// Nandi
"Aldai": ["Kabwareng", "Kaptumo-Kaboi", "Kemeloi-Maraba", "Koyo-Ndurio", "Terik", "Kebulonik"],
"Chesumei": ["Chemundu-Kapng’etuny", "Kosirai", "Lelmokwo/Ngechek", "Kaptel-Kamoiywo", "Chesumei"],
"Emgwen": ["Cheptarit", "Kaptembwo", "Kapsabet", "Kilibwoni"],
"Mosop": ["Kabiyet", "Kipkaren", "Ndalat", "Kurgung/Surungai", "Chepkumia", "Sang’alo/Kein"],
"Nandi Hills": ["Nandi Hills", "Chepkunyuk", "O'lessos", "Kapchorwa"],
"Tinderet": ["Tinderet", "Chemelil/Chemase", "Songhor/Soba", "Kapkures"],

// Baringo
"Baringo Central": ["Kabarnet", "Ewalel Chapchap", "Tenges", "Sacho", "Kapropita"],
"Baringo North": ["Barwesa", "Kabartonjo", "Saimo/Kipsaraman", "Saimo/Soi"],
"Baringo South": ["Marigat", "Ilchamus", "Mochongoi", "Mukutani"],
"Mogotio": ["Emining", "Mochongoi", "Mogotio"],
"Eldama Ravine": ["Lembus", "Lembus Perkerra", "Ravine", "Mumberes/Maji Mazuri", "Koibatek"],
"Tiaty": ["Tangulbei/Korossi", "Kolowa", "Silale", "Loiyamorock", "Tirioko"],

// Laikipia
"Laikipia East": ["Ngobit", "Tigithi", "Thingithu", "Nanyuki", "Umande"],
"Laikipia North": ["Mukogodo East", "Mukogodo West", "Sosian", "Segera"],
"Laikipia West": ["Ol-Moran", "Rumuruti Township", "Githiga", "Salama", "Marmanet"],
"Nyahururu": ["Igwamiti", "Gatimu", "Kanyagia", "Thiru", "Nyahururu Town"],
// Kakamega
"Lugari": ["Mautuma", "Lugari", "Lumakanda", "Chekalini", "Chevaywa", "Lawandeti"],
"Likuyani": ["Likuyani", "Sango", "Kongoni", "Nzoia", "Sinoko"],
"Malava": ["West Kabras", "East Kabras", "Butali/Chegulo", "Manda-Shivanga", "Shirugu-Mugai", "South Kabras", "Chemuche"],
"Lurambi": ["Butsotso East", "Butsotso South", "Butsotso Central", "Shirere", "Mahiakalo", "Township"],
"Navakholo": ["Ingotse-Mathia", "Shinyalu", "Bunyala West", "Bunyala East", "Navakholo"],
"Shinyalu": ["Isukha South", "Isukha Central", "Isukha North", "Murhanda", "Isukha East", "Isukha West"],
"Ikolomani": ["Idakho South", "Idakho East", "Idakho North", "Idakho Central"],
"Mumias East": ["Lusheya-Lubinu", "Malaha/Isongo/Makunga", "East Wanga"],
"Mumias West": ["Mumias Central", "Mumias North", "Etenje", "Musanda"],
"Butere": ["Marama West", "Marama Central", "Marama North", "Marama South"],
"Khwisero": ["Kisa North", "Kisa East", "Kisa West", "Kisa Central"],
"Matungu": ["Koyonzo", "Kholera", "Khalaba", "Namamali"],

// Vihiga
"Vihiga": ["Lugaga-Wamuluma", "South Maragoli", "Central Maragoli", "Mungoma"],
"Sabatia": ["Lyaduywa/Izava", "West Sabatia", "Chavakali", "North Maragoli", "Wodanga", "Busali"],
"Luanda": ["Luanda Township", "Wemilabi", "Mwibona", "Emabungo", "Ekwanda"],
"Hamisi": ["Shiru", "Gisambai", "Shamakhokho", "Banja", "Muhudu", "Tambua", "Jepkoyai"],
"Emuhaya": ["North East Bunyore", "West Bunyore", "Central Bunyore"],


// Busia
"Teso North": ["Malaba Central", "Malaba North", "Malaba South", "Angurai South", "Angurai North", "Angurai East"],
"Teso South": ["Ang’orom", "Chakol South", "Amukura East", "Amukura Central", "Amukura West"],
"Nambale": ["Bukhayo North/Waltsi", "Bukhayo East", "Bukhayo Central", "Bukhayo West"],
"Matayos": ["Mayenje", "Busibwabo", "Burumba", "Busia Township", "Bukhayo South"],
"Butula": ["Marachi East", "Marachi Central", "Marachi West", "Kingandole", "Elugulu"],
"Funyula": ["Nangina", "Ageng’a/Nanguba", "Namboboto-Nambuku", "Bwiri"],
"Bunyala": ["Bunyala North", "Bunyala Central", "Bunyala South", "Bunyala West"],

// Siaya
"Ugenya": ["North Ugenya", "Ugunja", "West Ugenya", "East Ugenya"],
"Ugunja": ["Ugunja", "Sidindi", "Sigomere"],
"Alego Usonga": ["Usonga", "West Alego", "Central Alego", "South East Alego", "Siaya Township", "North Alego"],
"Gem": ["North Gem", "East Gem", "Yala Township", "West Gem", "South Gem", "Central Gem"],
"Bondo": ["West Yimbo", "Central Sakwa", "South Sakwa", "Yimbo East", "North Sakwa", "Usigu"],
"Rarieda": ["West Asembo", "East Asembo", "North Uyoma", "South Uyoma", "East Uyoma"],

// Kisumu
"Kisumu East": ["Kajulu", "Kolwa East", "Manyatta 'B'", "Nyalenda 'A'", "Kolwa Central"],
"Kisumu West": ["South West Kisumu", "Central Kisumu", "West Kisumu", "North West Kisumu", "North Kisumu"],
"Kisumu Central": ["Railways", "Migosi", "Shaurimoyo Kaloleni", "Market Milimani", "Nyalenda B"],
"Seme": ["West Seme", "Central Seme", "East Seme", "North Seme"],
"Nyando": ["East Kano/Wawidhi", "Awasi/Onjiko", "Ahero", "Kabonyo/Kanyagwal", "Kobura"],
"Muhoroni": ["Ombeyi", "Masogo/Nyang’oma", "Chemelil", "Muhoroni/Koru", "Miwani"],
"Nyakach": ["South East Nyakach", "West Nyakach", "North Nyakach", "Central Nyakach", "West Kabodho"],

// Homa Bay
"Ndhiwa": ["Kabuoch North", "Kabuoch South/Pala", "Kanyadoto", "Kanyikela", "Kojwach", "Kochia", "Kwabwai"],
"Rangwe": ["West Gem", "East Gem", "Kagan", "Kochia"],
"Homa Bay Town": ["Homa Bay Central", "Homa Bay East", "Homa Bay West", "Homa Bay Arujo"],
"Rachuonyo North": ["Kibiri", "Kendu Bay Town", "North Karachuonyo", "Wang’chieng", "West Karachuonyo", "Kibiri East"],
"Rachuonyo South": ["Kojwach", "Kabondo East", "Kabondo West", "Kobuya"],
"Suba North": ["Mfangano", "Kasgunga", "Lambwe", "Gember", "Rusinga"],
"Suba South": ["Kaksingri West", "Gwassi South", "Gwassi North"],

// Migori
"Rongo": ["North Kamagambo", "East Kamagambo", "Central Kamagambo", "South Kamagambo"],
"Awendo": ["North Sakwa", "South Sakwa", "West Sakwa", "Central Sakwa"],
"Suna East": ["God Jope", "Suna Central", "Kakrao", "Kwa"],
"Suna West": ["Wasweta I", "Wasweta II", "Ragana-Oruba", "Wiga"],
"Uriri": ["West Kanyamkago", "Central Kanyamkago", "South Kanyamkago", "North Kanyamkago"],
"Nyatike": ["Kachieng", "Kanyasa", "North Kadem", "Macalder/Kanyarwanda", "Got Kachola", "Muhuru"],
"Kuria East": ["Gokeharaka/Getambwega", "Ntimaru East", "Ntimaru West", "Nyabasi East", "Nyabasi West"],
"Kuria West": ["Bukira East", "Bukira Central/Ikerege", "Isibania", "Makerero", "Masaba", "Tagare", "Nyamosense/Komosoko"],
 // Kwale
  "Kwale": ["Timbwani", "Kibanda", "Mwereni", "Mzwandani", "Mwena", "Tsimba", "Matsangoni"],
  "Kinango": ["Vanga", "Bodo", "Ukunda", "Mokowe", "Ngambenyi", "Mwachabo"],
  "Lunga Lunga": ["Matuga", "Tsimba", "Lunga Lunga", "Pwani Mchangani"],
  "Msambweni": ["Msambweni", "Tiwi", "Ngombeni", "Mwereni", "Diani"],
  "Matuga": ["Mwachinga", "Mwaemba", "Bomani", "Mwarakaya", "Tsavo East"],
  
  // Kilifi
  "Kilifi North": ["Mnarani", "Matsangoni", "Tezo", "Tezo East"],
  "Kilifi South": ["Ganze", "Magarini", "Malindi Central", "Malindi West", "Malindi North"],
  "Rabai": ["Rabia", "Marafa", "Munici", "Mwawesa"],
  "Ganze": ["Kilifi South", "Kilifi East", "Kilifi West", "Mariakani"],
  
  // Tana River
  "Tana North": ["Garsen East", "Garsen Central", "Garsen West"],
  "Tana South": ["Galole", "Diame", "Hulugho"],
  "Tana Delta": ["Bura", "Arduino", "Madogo"],
  
  // Lamu
  "Lamu East": ["Kiunga", "Basuba", "Faza", "Shanga"],
  "Lamu West": ["Shela", "Mkomani", "Hindi", "Bahari"],
  
  // Taita-Taveta
  "Mwatate": ["Kaloleni", "Mwanda", "Mwachabo", "Athi"],
  "Voi": ["Voi West", "Taveta", "Mboghoni", "Taveta Central"],
  "Taveta": ["Bura", "Rongai", "Mboghoni", "Nguu/Masumba"],
  
  /* North-Eastern Region */
  // Garissa
  "Garissa Township": ["Garissa Central", "Garissa Iftin", "Garissa Dujis"],
  "Fafi": ["Fafi North", "Ali Adde", "Ferfer", "Modogashe"],
  "Ijara": ["Ijara Central", "Ijara East", "Ijara West"],
  "Lagdera": ["Elsom", "Lagdera West", "Lagdera East"],
  "Balambala": ["Balambala", "Kutulo"],
  
  // Wajir
  "Wajir East": ["Eldas", "Dadajabula", "Korondile", "Sabuli"],
  "Wajir North": ["Hadado", "Dadajabula North", "Waar"],
  "Wajir South": ["Arbajahan", "Merre", "Malkamari"],
  "Wajir West": ["Wajir West Central", "Bute", "Gurar"],
  "Wajir East": ["Bute East", "Bute South", "Bute North"],
  
  // Mandera
  "Mandera East": ["Kutulo", "Tulay", "Takaba South"],
  "Mandera West": ["Takaba", "Mandera West", "Takaba Central"],
  "Mandera North": ["Elwak North", "Elwak West", "Elwak South"],
  "Mandera South": ["Mandera South", "Mandera East", "Guba"],
  
  // Marsabit
  "Marsabit Central": ["Korr", "Laisamis"],
  "Saku": ["Turbi", "Kalacha", "Shurr"],
  "North Horr": ["North Horr", "Maikona"],
  
  // Isiolo
  "Isiolo North": ["Oldonyiro", "Kinna", "Kipsigita"],
  "Isiolo South": ["Merti", "Cherab", "Sericho"],
  
  /* Eastern & Central Region */
  // Meru (county-level sub-counties)
  "Imenti Central": ["Mwanganthia", "Gaitu", "Municipality", "Nkomo"],
  "Imenti North": ["Ntima East", "Ntima West", "Municipality", "Nyaki East", "Nyaki West"],
  "Imenti South": ["Abogeta East", "Abogeta West", "Nkuene", "Mitunguu"],
  "Tigania East": ["Thangatha", "Mitunguu", "Karama", "Muthara", "Antuambui"],
  "Tigania West": ["Athwana", "Kianjai", "Kiguchwa", "Mbeu", "Nkomo"],
  "Buuri": ["Timau", "Kisima", "Kiirua/Naari", "Ruiri/Rwarera"],
  "Igembe Central": ["Akirang'ondu", "Athiru", "Antubetwe Kiongo", "Igembe East"],
  "Igembe North": ["Amwathi", "Antuambui", "Ntunene", "Naathu"],
  "Igembe South": ["Maua", "Kangeta", "Kiegaene", "Athiru", "Kanuni"],
  // Tharaka-Nithi
  "Chuka/Igambang'ombe": ["Chiakariga", "Mugwe", "Igambang'ombe"],
  "Tharaka": ["Nithi", "Chogoria", "Thingithu"],
  "Maara": ["Maara", "Gitare/Karaba", "Riagu"],
  
  // Embu
  "Manyatta": ["Kamuwongo", "Kagaru", "Gakoromone", "Njukini"],
  "Runyenjes": ["Murinjo/Mutuati", "Nkubu", "Kagaari North", "Kagaari South"],
  "Mbeere North": ["Kithimu", "Kaitwetu", "Kiambere"],
  "Mbeere South": ["Kithimu", "Nyangati", "Mwea"],
  
  // Kitui
  "Kitui Central": ["Mwingi North", "Mwingi West", "Mwingi East"],
  "Kitui East": ["Matinyani", "Katulani", "Mutonguni"],
  "Kitui Rural": ["Migwani", "Mutituu", "Ikanga"],
  "Kitui South": ["Majoreni", "Nzambani", "Nuu"],
  "Kitui West": ["Mutha", "Nthangeni", "Juhudi"],
// Nyamira
"Borabu": ["Esise", "Mekenene", "Kiabonyoru", "Nyansiongo"],
"Manga": ["Kemera", "Magombo", "Gachuba", "Rigoma"],
"Masaba North": ["Gesima", "Gachuba", "Kemera"],
"Nyamira North": ["Ekerenyo", "Magwagwa", "Bokeira", "Bomwagamo", "Itibo"],
"Nyamira South": ["Bogichora", "Bosamaro", "Bonyamatuta", "Township"],

// Makueni
"Kaiti": ["Ukia", "Kee", "Kilungu", "Ilima"],
"Kibwezi East": ["Masongaleni", "Mtito Andei", "Thange", "Ivingoni/Nzambani"],
"Kibwezi West": ["Makindu", "Nguumo", "Nguu/Masumba", "Emali/Mulala"],
"Kilome": ["Kasikeu", "Mukaa", "Kiima Kiu/Kalanzoni"],
"Makueni": ["Wote", "Muvau/Kikumini", "Mavindini", "Mzwaneni", "Kitise/Kithuki"],
"Mbooni": ["Tulimani", "Mbooni", "Kithungo/Kitundu", "Kiteta/Kisau", "Kalawa"],
// Murang'a
"Gatanga": ["Kakuzi/Mitubiri", "Ithanga", "Kihumbu-ini", "Gatanga", "Kariara"],
"Kahuro": ["Mugoiri", "Murarandia", "Muguru"],
"Kandara": ["Gaichanjiru", "Ng’araria", "Muruka", "Kagundu-ini", "Ithiru"],
"Kangema": ["Kanyenya-ini", "Muguru", "Rwathia"],
"Kigumo": ["Kangari", "Kinyona", "Muthithi", "Kinyona East"], 
"Kiharu": ["Wangu", "Mugoiri", "Mbiri", "Township", "Gaturi", "Kimathi"],
"Mathioya": ["Githuya", "Kamacharia", "Gitugi"],

// Narok
"Narok East": ["Mosiro", "Ildamat", "Keekonyokie", "Suswa"],
"Narok North": ["Olokurto", "Ololulung’a", "Olorropil", "Melili", "Nkareta"],
"Narok South": ["Majimoto/Naroosura", "Melelo", "Loita", "Sogoo", "Sagamu"],
"Narok West": ["Ilmotiok", "Mara", "Naikarra", "Siana"],
"Trans Mara East": ["Ilkerin", "Ololmasani", "Mogondo"],
"Trans Mara West": ["Lolgorian", "Kapsasian", "Keyian", "Angata Barikoi", "Kilgoris Central"],

// Bungoma
"Bumula": ["Khasoko", "Kabula", "South Bukusu", "West Bukusu", "Bumula"],
"Kabuchai": ["Mukuyuni", "Kabuchai/Chwele", "West Nalondo", "Bwake/Luuya"],
"Kanduyi": ["Bukembe East", "Bukembe West", "Township", "Khalaba", "Musikoma", "Marakaru/Tuuti", "Mihuu"],
"Kimilili": ["Maeni", "Kimilili", "Milima", "Kibingei"],
"Mt. Elgon": ["Cheptais", "Chesikaki", "Kaptama", "Kapsokwony", "Elgon"],
"Sirisia": ["Namwela", "Malakisi/South Kulisiru", "Lwandanyi"],
"Tongaren": ["Naitiri/Kabuyefwe", "Mbakalo", "Milima", "Ndalu/Tabani", "Tongaren"],
"Webuye East": ["Mihuu", "Ndivisi", "Maraka"],
"Webuye West": ["Misikhu", "Bokoli", "Sitikho", "Matulo"]


  };

  // Function to populate wards
  function loadWards() {
    const scSelect = document.getElementById('sub_county');
    const wardSelect = document.getElementById('ward');
    const wards = subCountyToWards[scSelect.value] || [];

    // Reset wards dropdown
    wardSelect.innerHTML = '<option value="">Select Ward</option>';

    wards.forEach(w => {
      const opt = document.createElement('option');
      opt.value = w;
      opt.textContent = w;
      wardSelect.appendChild(opt);
    });
  }

  // Setup event listeners and pre-population
  document.addEventListener('DOMContentLoaded', () => {
    const scSelect = document.getElementById('sub_county');
    
    if (scSelect) {
      scSelect.addEventListener('change', loadWards);
      
      // If form is loaded with a value (e.g., editing), auto populate
      if (scSelect.value) {
        loadWards();
        const selectedWard = "{{ old('ward', $user->ward) }}";
        if (selectedWard) {
          document.getElementById('ward').value = selectedWard;
        }
      }
    }
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const disabilityStatus = document.getElementById('disability_status');
    const certificateField = document.getElementById('certificateField');
    const certificateInput = document.getElementById('disability_certificate_number');

    function toggleCertificateField() {
        if (disabilityStatus.value === 'yes') {
            certificateField.style.display = 'block';
            certificateInput.removeAttribute('readonly');
            certificateInput.value = '';
        } else {
            certificateField.style.display = 'none';
            certificateInput.value = 'N/A';
            certificateInput.setAttribute('readonly', 'readonly');
        }
    }

    // Call it on page load
    toggleCertificateField();

    // Call it whenever the selection changes
    disabilityStatus.addEventListener('change', toggleCertificateField);
});
</script>

