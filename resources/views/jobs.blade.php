<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('title' , 'All Projects Page')

    @section('desc' , 'in this Page You Can See All Jobs and filter it depends on your requirements')
    @section('keywords' , 'ifreelacner, freelance, freelancer , project , jobs , jobs in egypt , عمل_حر , jobs, projects')

    @section('adds')
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endsection
  <body>
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    <section class="bg">
      <h1>{{ $category ? ucwords(str_replace('-', ' ', $category)) : 'Find All'}}</h1>
       <p><a href="/">Home</a> / <span>{{ $category ? ucwords(str_replace('-', ' ', $category)) : 'Find All'}}</span></p>
    </section>
    <p class="data" style="display: none">
      {{ $jobs }}
    </p>
    <section class="content jobs">
      <nav>
        <form action="/jobs" method="get" class="filters">
          @csrf
          <div class="filter">
            <h3>Filter Project By</h3>
            <div class="inputs row">
              <h4>Project Type</h4>
              <div class="input">
                <input type="radio" name="radio-price" value="all" id="all" 
                {{ session('radio-price') == 'all' ? 'checked' : '' }} />
                <label for="all">All</label>
              </div>
              <div class="input">
                <input type="radio" name="radio-price" value="fixed"  id="fixed" 
                {{ session('radio-price') == 'fixed' ? 'checked' : '' }} />
                <label for="fixed">Fixed Price</label>
              </div>
              <div class="input">
                <input type="radio" name="radio-price" value="hourly" id="hourly" 
                {{ session('radio-price') == 'hourly' ? 'checked' : '' }} />
                <label for="hourly">Hourly Based Project</label>
              </div>
              <div class="input" style="flex-direction: column">
                <input
                  type="range"
                  min="1"
                  class="priceRange"
                  max="1000"
                  step="1"
                  value="{{ session('price') ?? 900 }}"
                  id="price"
                  placeholder="Type keyword"
                />
                <label for="price"
                  ><span class="min">1</span>$ -
                  <span class="max">{{ session('price') ?? 900 }}</span>$</label
                >
              </div>
              <div class="input prices">
                <input
                  type="number"
                  value="{{ session('priceMin') ?? 1 }}"
                  min="1"
                  max="1000"
                  name="priceMin"
                  class="min"
                />
                <input
                  type="number"
                  min="1"
                  value="{{ session('priceMax') ?? 900 }}"
                  max="1000"
                  name="priceMax"
                  class="max"
                />
              </div>
            </div>
          </div>
          <div class="filter">
            <h3>
              <p>
                Project Name:
              </p>
              <i class="fa-solid fa-arrow-down"></i>
            </h3>
            <div class="inputs inputs-search row" hidden>
              <div class="input">
                <input
                  type="search"
                  name="keyword"
                  placeholder="Search Of Proejct Name"
                  class="searchProjectName"
                  value="{{request('keyword')}}"
                />
                <!-- <i class="fa-brands fa-searchengin search-category"></i> -->
              </div>
            </div>
          </div>
          <div class="filter">
            <h3>
              <p>
                Categories:
                <span>( <span>0</span> Selected )</span>
              </p>
              <i class="fa-solid fa-arrow-down"></i>
            </h3>
            <div class="inputs inputs-search row" hidden>
              <div class="input">
                <input
                  type="search"
                  name="search-category"
                  placeholder="Search Categories"
                  class="searchInput"
                />
                <!-- <i class="fa-brands fa-searchengin search-category"></i> -->
              </div>
              <div class="category-result">
                @foreach (config('categories') as $category)
                  <div class="input">
                    <input type="checkbox" name="{{$category}}" id="{{$category}}">
                    <label for="{{$category}}">{{  str_replace( '-', ' ', trim( ucwords( strtolower( $category ) ) ) )  }}</label>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="filter">
            <h3>
              <p>
                Skills:
                <span>( <span>0</span> Selected )</span>
              </p>
              <i class="fa-solid fa-arrow-down"></i>
            </h3>
            <div class="inputs inputs-search row" hidden>
              <div class="input">
                <input
                  type="search"
                  name="search-skills"
                  placeholder="Search Skills"
                  class="searchInput"
                />
                <!-- <i class="fa-brands fa-searchengin search-category"></i> -->
              </div>
              <div class="skills-result">
                  @foreach (config('skills') as $skill)
                  <div class="input">
                    <input type="checkbox" name="{{$skill}}" id="{{$skill}}">
                    <label for="{{$skill}}">{{$skill}}</label>
                  </div>
                  @endforeach
              </div>
            </div>
          </div>
          <div class="filter">
            <h3>
              <p>
                English Level:
                <span>( <span>0</span> Selected )</span>
              </p>
              <i class="fa-solid fa-arrow-down"></i>
            </h3>
            <div class="inputs row" hidden>
              <div class="input">
                <input type="checkbox" id="basic" value="basic" name="english-level[]" 
                {{ in_array('basic', session('english-level', [])) ? 'checked' : '' }} />
                <label for="basic">Basic</label>
              </div>
              <div class="input">
                <input type="checkbox" id="conversational" name="english-level[]" value="conversational" 
                {{ in_array('conversational', session('english-level', [])) ? 'checked' : '' }} />
                <label for="conversational">Conversational</label>
              </div>
              <div class="input">
                <input type="checkbox" id="fluent" value="fluent" name="english-level[]" 
                {{ in_array('fluent', session('english-level', [])) ? 'checked' : '' }} />
                <label for="fluent">Fluent</label>
              </div>
              <div class="input">
                <input type="checkbox" id="native-or-bilingual" value="native-or-bilingual" name="english-level[]" 
                {{ in_array('native-or-bilingual', session('english-level', [])) ? 'checked' : '' }} />
                <label for="native-or-bilingual">Native Or Bilingual</label>
              </div>
              <div class="input">
                <input type="checkbox" value="professional" id="professional" name="english-level[]" 
                {{ in_array('professional', session('english-level', [])) ? 'checked' : '' }} />
                <label for="professional">Professional</label>
              </div>
            </div>
          </div>
          <div class="filter">
            <h3>
              <p>
                Job Type:
                <span>( <span>0</span> Selected )</span>
              </p>
              <i class="fa-solid fa-arrow-down"></i>
            </h3>
            <div class="inputs row" hidden>
              <div class="input">
                <input type="checkbox" id="onsite" value="onsite" name="type[]" 
                {{ in_array('onsite', session('type', [])) ? 'checked' : '' }} />
                <label for="onsite">Onsite</label>
              </div>
              <div class="input">
                <input type="checkbox" id="partial" value="partial" name="type[]" 
                {{ in_array('partial', session('type', [])) ? 'checked' : '' }} />
                <label for="partial">Partial Onsite</label>
              </div>
              <div class="input">
                <input type="checkbox" id="remote" value="remote" name="type[]" 
                {{ in_array('remote', session('type', [])) ? 'checked' : '' }} />
                <label for="remote">Remote</label>
              </div>
            </div>
          </div>
          <div class="filter">
            <h3>
              <p>
                Freelancer type:
                <span>( <span>0</span> Selected )</span>
              </p>
              <i class="fa-solid fa-arrow-down"></i>
            </h3>
            <div class="inputs row" hidden>
              <div class="input">
                <input type="checkbox" id="Agency" value="Agency" name="freelancer-type[]" 
                {{ in_array('Agency', session('freelancer-type', [])) ? 'checked' : '' }} />
                <label for="Agency">Agency Freelancers</label>
              </div>
              <div class="input">
                <input
                  type="checkbox"
                  value="Independent"
                  id="Independent"
                  name="freelancer-type[]"
                  {{ in_array('Independent', session('freelancer-type', [])) ? 'checked' : '' }}
                />
                <label for="Independent">Independent Freelancers</label>
              </div>
              <div class="input">
                <input type="checkbox" id="Rising" value="Rising" name="freelancer-type[]" 
                {{ in_array('Rising', session('freelancer-type', [])) ? 'checked' : '' }} />
                <label for="Rising">New Rising Talent</label>
              </div>
            </div>
          </div>
          <div class="filter">
            <h3>
              <p>
                Project Length:
                <span>( <span>0</span> Selected )</span>
              </p>
              <i class="fa-solid fa-arrow-down"></i>
            </h3>
            <div class="inputs row" hidden>
              <div class="input">
                <input
                  type="checkbox"
                  id="Less than a week"
                  value="Less than a week"
                  name="project-length[]"
                  {{ in_array('Less than a week', session('project-length', [])) ? 'checked' : '' }}
                />
                <label for="Less than a week">Less than a week</label>
              </div>
              <div class="input">
                <input
                  type="checkbox"
                  id="Less than a month"
                  value="Less than a month"
                  name="project-length[]"
                  {{ in_array('Less than a month', session('project-length', [])) ? 'checked' : '' }}
                />
                <label for="Less than a month">Less than a month</label>
              </div>
              <div class="input">
                <input
                  type="checkbox"
                  id="01 to 03 months"
                  value="01 to 03 months"
                  name="project-length[]"
                  {{ in_array('01 to 03 months', session('project-length', [])) ? 'checked' : '' }}
                />
                <label for="01 to 03 months">01 to 03 months</label>
              </div>
              <div class="input">
                <input
                  type="checkbox"
                  id="03 to 06 months"
                  value="03 to 06 months"
                  name="project-length[]"
                  {{ in_array('03 to 06 months', session('project-length', [])) ? 'checked' : '' }}
                />
                <label for="03 to 06 months">03 to 06 months</label>
              </div>
              <div class="input">
                <input
                  type="checkbox"
                  id="More than 06 months"
                  value="More than 06 months"
                  name="project-length[]"
                  {{ in_array('More than 06 months', session('project-length', [])) ? 'checked' : '' }}
                />
                <label for="More than 06 months">More than 06 months</label>
              </div>
            </div>
          </div>
          <p>Click “Apply Filter” to apply latest changes made by you.</p>
          <input type="submit" class="btn" value="Apply Vilters" />
        </form>
      </nav>
      <div class="cards">

      </div>
    </section>

    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->
    <script src="{{ asset('js/category.js') }}"></script>
    <script src="{{ asset('js/range.js') }}"></script>
    <script>
      categories.forEach(category => createCheckBoxAbout(category,document.querySelector('.category-result')));
      
    </script>
    <script src="{{ asset('js/jobs.js') }}"></script>
  </body>
</html>
