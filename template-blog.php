<?php 
// Template Name: Blog Template
get_header();

?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="grid-pattern"></div>
  <div class="particles-bg"></div>
  <div class="geo-blob blob-gold" style="width:450px;height:450px;top:-120px;right:-80px;position:absolute;z-index:1;"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="section-label" style="justify-content:center;" ><i class="fas fa-newspaper"></i>&nbsp; Insights & Ideas</div>
    <h1 class="page-hero-title">Blog &amp; <span style="color:var(--gold);">Insights</span></h1>
    <p style="color:var(--grey);font-size:.9rem;margin-top:12px;">Expert perspectives on real estate, investment, infrastructure, and the future of the built environment.</p>
    <div class="page-breadcrumb">
      <a href="index.html">Home</a><i class="fas fa-chevron-right"></i>
      <span style="color:var(--gold);">Blog</span>
    </div>
  </div>
</section>

<!-- BLOG CONTENT -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">

      <!-- LEFT MAIN -->
      <div class="col-lg-8">
        <!-- Category Filter -->
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:28px;" class="reveal">
          <div class="filter-bar" style="margin-bottom:0;flex:1;">
            <button class="blog-cat-btn filter-btn active" data-cat="all">All</button>
            <button class="blog-cat-btn filter-btn" data-cat="real estate">Real Estate</button>
            <button class="blog-cat-btn filter-btn" data-cat="investment">Investment</button>
            <button class="blog-cat-btn filter-btn" data-cat="technology">Technology</button>
            <button class="blog-cat-btn filter-btn" data-cat="infrastructure">Infrastructure</button>
          </div>
          <div class="search-input-wrap" style="max-width:220px;">
            <i class="fas fa-search"></i>
            <input type="text" id="blogSearch" placeholder="Search articles…"/>
          </div>
        </div>

        <!-- Featured Post -->
        <div data-blog-card data-title="the future of mixed-use developments in mena" data-tags="real estate trends" data-category="real estate" class="doma-card reveal" style="overflow:hidden;margin-bottom:28px;">
          <div style="width:100%;height:300px;background:linear-gradient(135deg,#1e3a52,#304A61,rgba(188,132,43,.15));display:flex;align-items:center;justify-content:center;position:relative;">
            <div class="particles-bg"></div>
            <div class="grid-pattern" style="opacity:.4;"></div>
            <div style="position:relative;z-index:2;text-align:center;">
              <i class="fas fa-city" style="font-size:5rem;color:rgba(188,132,43,.25);"></i>
            </div>
            <div style="position:absolute;top:16px;left:16px;"><span class="blog-category-badge" style="position:static;">Real Estate</span></div>
            <div style="position:absolute;top:16px;right:16px;background:rgba(188,132,43,.15);border:1px solid rgba(188,132,43,.3);border-radius:50px;padding:5px 12px;font-size:.7rem;font-weight:700;color:var(--gold);letter-spacing:.08em;">FEATURED</div>
          </div>
          <div style="padding:30px;">
            <div class="blog-meta-row">
              <span class="blog-meta-item"><i class="fas fa-calendar-alt"></i> May 8, 2025</span>
              <span class="blog-meta-item"><i class="fas fa-user"></i> Khalid Al-Rashid</span>
              <span class="blog-meta-item"><i class="fas fa-clock"></i> 8 min read</span>
            </div>
            <h2 style="font-family:var(--font-heading);font-size:1.5rem;font-weight:700;margin-bottom:14px;line-height:1.3;">The Future of Mixed-Use Developments in MENA: Trends Shaping the Next Decade</h2>
            <p style="font-size:.9rem;color:var(--grey);line-height:1.8;margin-bottom:20px;">Mixed-use real estate is no longer a trend — it's the default format for urban development across the Middle East and North Africa. As cities mature and populations urbanize, the demand for integrated live-work-play environments is accelerating exponentially…</p>
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
              <div style="display:flex;gap:8px;flex-wrap:wrap;">
                <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:4px 12px;font-size:.7rem;color:var(--grey);">#RealEstate</span>
                <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:4px 12px;font-size:.7rem;color:var(--grey);">#MENA</span>
                <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:4px 12px;font-size:.7rem;color:var(--grey);">#Trends</span>
              </div>
              <a href="#" class="blog-read-more">Read Article <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Blog Grid -->
        <div class="row g-4">

          <div class="col-md-6" data-blog-card data-title="how ai is transforming property valuations" data-tags="ai technology proptech" data-category="technology">
            <div class="blog-card reveal delay-100">
              <div class="blog-card-img">
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center;"><i class="fas fa-brain" style="font-size:3.5rem;color:rgba(188,132,43,.3);"></i></div>
                <span class="blog-category-badge">Technology</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-meta-row">
                  <span class="blog-meta-item"><i class="fas fa-calendar-alt"></i> Apr 28, 2025</span>
                  <span class="blog-meta-item"><i class="fas fa-clock"></i> 6 min</span>
                </div>
                <h3 class="blog-card-title">How AI is Transforming Property Valuations Across the Gulf</h3>
                <p class="blog-card-desc">Machine learning models are achieving valuation accuracy within 2.1% of market price — disrupting traditional appraisal methods across the GCC.</p>
                <div style="display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap;">
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#AI</span>
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#PropTech</span>
                </div>
                <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6" data-blog-card data-title="infrastructure investment opportunities 2025" data-tags="investment infrastructure returns" data-category="investment">
            <div class="blog-card reveal delay-200">
              <div class="blog-card-img">
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#1a2a1a,#2a3a2a);display:flex;align-items:center;justify-content:center;"><i class="fas fa-chart-bar" style="font-size:3.5rem;color:rgba(188,132,43,.3);"></i></div>
                <span class="blog-category-badge">Investment</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-meta-row">
                  <span class="blog-meta-item"><i class="fas fa-calendar-alt"></i> Apr 15, 2025</span>
                  <span class="blog-meta-item"><i class="fas fa-clock"></i> 7 min</span>
                </div>
                <h3 class="blog-card-title">Infrastructure Investment Opportunities Generating 12%+ IRR in 2025</h3>
                <p class="blog-card-desc">Transport, energy, and digital infrastructure projects continue to deliver superior risk-adjusted returns compared to traditional asset classes.</p>
                <div style="display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap;">
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#Investment</span>
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#Returns</span>
                </div>
                <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6" data-blog-card data-title="green hydrogen gulf energy transition" data-tags="energy sustainability hydrogen" data-category="infrastructure">
            <div class="blog-card reveal delay-100">
              <div class="blog-card-img">
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#0a2a0a,#1a3a1a);display:flex;align-items:center;justify-content:center;"><i class="fas fa-atom" style="font-size:3.5rem;color:rgba(188,132,43,.3);"></i></div>
                <span class="blog-category-badge">Infrastructure</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-meta-row">
                  <span class="blog-meta-item"><i class="fas fa-calendar-alt"></i> Apr 2, 2025</span>
                  <span class="blog-meta-item"><i class="fas fa-clock"></i> 5 min</span>
                </div>
                <h3 class="blog-card-title">Green Hydrogen: The Gulf's Next Energy Frontier</h3>
                <p class="blog-card-desc">With abundant solar resources and strategic geography, GCC nations are positioning themselves as global green hydrogen exporters by 2030.</p>
                <div style="display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap;">
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#Hydrogen</span>
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#ESG</span>
                </div>
                <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6" data-blog-card data-title="grade a office demand post pandemic dubai" data-tags="real estate office dubai" data-category="real estate">
            <div class="blog-card reveal delay-200">
              <div class="blog-card-img">
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#1e2f3d,#304A61);display:flex;align-items:center;justify-content:center;"><i class="fas fa-building" style="font-size:3.5rem;color:rgba(188,132,43,.3);"></i></div>
                <span class="blog-category-badge">Real Estate</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-meta-row">
                  <span class="blog-meta-item"><i class="fas fa-calendar-alt"></i> Mar 20, 2025</span>
                  <span class="blog-meta-item"><i class="fas fa-clock"></i> 6 min</span>
                </div>
                <h3 class="blog-card-title">Dubai's Grade-A Office Market: Why Demand is Outpacing Supply in 2025</h3>
                <p class="blog-card-desc">Record office leasing activity and sub-5% vacancy rates signal a structural shift in Dubai's commercial real estate landscape driven by corporate relocations.</p>
                <div style="display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap;">
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#Dubai</span>
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#Office</span>
                </div>
                <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6" data-blog-card data-title="private equity real estate mena 2025 outlook" data-tags="private equity investment funds" data-category="investment">
            <div class="blog-card reveal delay-300">
              <div class="blog-card-img">
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#200a2a,#301a3a);display:flex;align-items:center;justify-content:center;"><i class="fas fa-coins" style="font-size:3.5rem;color:rgba(188,132,43,.3);"></i></div>
                <span class="blog-category-badge">Investment</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-meta-row">
                  <span class="blog-meta-item"><i class="fas fa-calendar-alt"></i> Mar 5, 2025</span>
                  <span class="blog-meta-item"><i class="fas fa-clock"></i> 9 min</span>
                </div>
                <h3 class="blog-card-title">Private Equity Real Estate in MENA: 2025 Outlook and Emerging Opportunities</h3>
                <p class="blog-card-desc">LP appetite for MENA real estate is at a decade high. Here's what institutional investors are targeting and why the opportunity window is narrowing.</p>
                <div style="display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap;">
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#PE</span>
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#MENA</span>
                </div>
                <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6" data-blog-card data-title="smart city infrastructure iot connectivity" data-tags="smart city technology iot" data-category="technology">
            <div class="blog-card reveal delay-400">
              <div class="blog-card-img">
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#001a2a,#002a3a);display:flex;align-items:center;justify-content:center;"><i class="fas fa-network-wired" style="font-size:3.5rem;color:rgba(188,132,43,.3);"></i></div>
                <span class="blog-category-badge">Technology</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-meta-row">
                  <span class="blog-meta-item"><i class="fas fa-calendar-alt"></i> Feb 18, 2025</span>
                  <span class="blog-meta-item"><i class="fas fa-clock"></i> 7 min</span>
                </div>
                <h3 class="blog-card-title">Smart City Infrastructure: How IoT is Reducing Urban Operating Costs by 30%</h3>
                <p class="blog-card-desc">From intelligent traffic management to predictive utility maintenance, real-world deployments are proving the ROI case for smart city infrastructure.</p>
                <div style="display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap;">
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#SmartCity</span>
                  <span style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:3px 10px;font-size:.68rem;color:var(--grey);">#IoT</span>
                </div>
                <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

        </div><!-- /row -->

        <!-- Pagination -->
        <div style="display:flex;align-items:center;gap:8px;margin-top:40px;" class="reveal">
          <a href="#" style="width:40px;height:40px;border-radius:var(--radius-sm);background:var(--gold);border:1px solid var(--gold);display:flex;align-items:center;justify-content:center;font-size:.82rem;font-weight:700;color:var(--black);">1</a>
          <a href="#" style="width:40px;height:40px;border-radius:var(--radius-sm);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:.82rem;color:var(--grey);">2</a>
          <a href="#" style="width:40px;height:40px;border-radius:var(--radius-sm);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:.82rem;color:var(--grey);">3</a>
          <a href="#" style="width:40px;height:40px;border-radius:var(--radius-sm);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:.82rem;color:var(--grey);">4</a>
          <a href="#" style="margin-left:4px;display:flex;align-items:center;gap:6px;font-size:.82rem;color:var(--gold);">Next <i class="fas fa-arrow-right"></i></a>
        </div>

      </div><!-- /col-8 -->

      <!-- RIGHT SIDEBAR -->
      <div class="col-lg-4">

        <!-- Search -->
        <div class="doma-card reveal" style="padding:24px;margin-bottom:20px;">
          <h4 style="font-family:var(--font-heading);font-size:.9rem;font-weight:700;margin-bottom:14px;color:var(--gold);"><i class="fas fa-search" style="margin-right:6px;"></i>Search</h4>
          <div class="search-input-wrap" style="max-width:100%;">
            <i class="fas fa-search"></i>
            <input type="text" id="blogSearchSidebar" placeholder="Search all articles…"/>
          </div>
        </div>

        <!-- Categories -->
        <div class="doma-card reveal delay-100" style="padding:24px;margin-bottom:20px;">
          <h4 style="font-family:var(--font-heading);font-size:.9rem;font-weight:700;margin-bottom:16px;color:var(--gold);"><i class="fas fa-folder" style="margin-right:6px;"></i>Categories</h4>
          <div style="display:flex;flex-direction:column;gap:10px;">
            <a href="#" style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:var(--radius-sm);font-size:.83rem;color:rgba(255,255,255,.75);transition:all .2s;">Real Estate<span style="background:var(--gold-pale);color:var(--gold);font-size:.7rem;font-weight:700;padding:2px 8px;border-radius:20px;">18</span></a>
            <a href="#" style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:var(--radius-sm);font-size:.83rem;color:rgba(255,255,255,.75);transition:all .2s;">Investment<span style="background:var(--gold-pale);color:var(--gold);font-size:.7rem;font-weight:700;padding:2px 8px;border-radius:20px;">14</span></a>
            <a href="#" style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:var(--radius-sm);font-size:.83rem;color:rgba(255,255,255,.75);transition:all .2s;">Technology<span style="background:var(--gold-pale);color:var(--gold);font-size:.7rem;font-weight:700;padding:2px 8px;border-radius:20px;">11</span></a>
            <a href="#" style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:var(--radius-sm);font-size:.83rem;color:rgba(255,255,255,.75);transition:all .2s;">Infrastructure<span style="background:var(--gold-pale);color:var(--gold);font-size:.7rem;font-weight:700;padding:2px 8px;border-radius:20px;">9</span></a>
            <a href="#" style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:var(--radius-sm);font-size:.83rem;color:rgba(255,255,255,.75);transition:all .2s;">Energy &amp; ESG<span style="background:var(--gold-pale);color:var(--gold);font-size:.7rem;font-weight:700;padding:2px 8px;border-radius:20px;">7</span></a>
          </div>
        </div>

        <!-- Popular Posts -->
        <div class="doma-card reveal delay-200" style="padding:24px;margin-bottom:20px;">
          <h4 style="font-family:var(--font-heading);font-size:.9rem;font-weight:700;margin-bottom:16px;color:var(--gold);"><i class="fas fa-fire" style="margin-right:6px;"></i>Popular Posts</h4>
          <div style="display:flex;flex-direction:column;gap:16px;">
            <div style="display:flex;gap:12px;align-items:flex-start;">
              <div style="width:60px;height:60px;border-radius:var(--radius-sm);background:linear-gradient(135deg,#1e3a52,#304A61);flex-shrink:0;display:flex;align-items:center;justify-content:center;"><i class="fas fa-city" style="color:rgba(188,132,43,.4);"></i></div>
              <div>
                <a href="#" style="font-size:.8rem;font-weight:600;line-height:1.4;display:block;margin-bottom:4px;color:rgba(255,255,255,.85);">The Future of Mixed-Use Developments in MENA</a>
                <span style="font-size:.7rem;color:var(--grey);">May 8, 2025</span>
              </div>
            </div>
            <div style="display:flex;gap:12px;align-items:flex-start;">
              <div style="width:60px;height:60px;border-radius:var(--radius-sm);background:linear-gradient(135deg,#1a1a2e,#16213e);flex-shrink:0;display:flex;align-items:center;justify-content:center;"><i class="fas fa-brain" style="color:rgba(188,132,43,.4);"></i></div>
              <div>
                <a href="#" style="font-size:.8rem;font-weight:600;line-height:1.4;display:block;margin-bottom:4px;color:rgba(255,255,255,.85);">How AI is Transforming Property Valuations</a>
                <span style="font-size:.7rem;color:var(--grey);">Apr 28, 2025</span>
              </div>
            </div>
            <div style="display:flex;gap:12px;align-items:flex-start;">
              <div style="width:60px;height:60px;border-radius:var(--radius-sm);background:linear-gradient(135deg,#1a2a1a,#2a3a2a);flex-shrink:0;display:flex;align-items:center;justify-content:center;"><i class="fas fa-chart-bar" style="color:rgba(188,132,43,.4);"></i></div>
              <div>
                <a href="#" style="font-size:.8rem;font-weight:600;line-height:1.4;display:block;margin-bottom:4px;color:rgba(255,255,255,.85);">Infrastructure Investment Generating 12%+ IRR</a>
                <span style="font-size:.7rem;color:var(--grey);">Apr 15, 2025</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Tags -->
        <div class="doma-card reveal delay-300" style="padding:24px;margin-bottom:20px;">
          <h4 style="font-family:var(--font-heading);font-size:.9rem;font-weight:700;margin-bottom:16px;color:var(--gold);"><i class="fas fa-tags" style="margin-right:6px;"></i>Popular Tags</h4>
          <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#RealEstate</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#MENA</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#Investment</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#Dubai</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#PropTech</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#AI</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#ESG</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#Infrastructure</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#PrivateEquity</a>
            <a href="#" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:50px;padding:5px 12px;font-size:.72rem;color:var(--grey);transition:all .2s;">#Hydrogen</a>
          </div>
        </div>

        <!-- Newsletter -->
        <div style="background:linear-gradient(135deg,var(--navy-dark),var(--bg-card));border:1px solid rgba(188,132,43,.2);border-radius:var(--radius-lg);padding:28px;text-align:center;" class="reveal delay-400 glow-anim">
          <i class="fas fa-envelope-open-text" style="font-size:2rem;color:var(--gold);opacity:.6;margin-bottom:12px;display:block;"></i>
          <h4 style="font-family:var(--font-heading);font-size:.95rem;font-weight:700;margin-bottom:8px;">Subscribe to Insights</h4>
          <p style="font-size:.78rem;color:var(--grey);margin-bottom:18px;line-height:1.65;">Get our weekly analysis on real estate, investment, and infrastructure delivered to your inbox.</p>
          <form class="newsletter-form" novalidate>
            <input type="email" class="newsletter-input" placeholder="Your email" required style="border-radius:var(--radius-sm) var(--radius-sm) 0 0;border-bottom:none;border-right:none;"/>
            <button type="submit" class="newsletter-btn" style="width:100%;border-radius:0 0 var(--radius-sm) var(--radius-sm);">Subscribe Free</button>
          </form>
        </div>

      </div><!-- /sidebar -->
    </div><!-- /row -->
  </div>
</section>

<!-- FOOTER -->
<?php get_footer(); ?>


<?php wp_footer(); ?>

</body>
</html>
