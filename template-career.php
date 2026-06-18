<?php 
// Template Name: Career Page
get_header();

?>

<!-- HERO -->
<section class="page-hero">
  <div class="hero-content">
    <div>
      <p class="hero-label">Join Our Team</p>
      <h1 class="hero-title">Shape the Future of <span>Real Estate</span></h1>
      <p class="hero-desc">At Doma, we don't just build properties — we build careers. Join a team of 1,200+ professionals redefining real estate excellence across the MENA region.</p>
      <a href="#open-roles" class="hero-btn">View Open Roles <i class="fa fa-arrow-down" style="margin-left:6px;"></i></a>
    </div>
    <div class="hero-stats">
      <div class="h-stat"><div class="h-stat-num">1,200+</div><div class="h-stat-label">Team Members</div></div>
      <div class="h-stat"><div class="h-stat-num">32</div><div class="h-stat-label">Nationalities</div></div>
      <div class="h-stat"><div class="h-stat-num">28</div><div class="h-stat-label">Open Positions</div></div>
      <div class="h-stat"><div class="h-stat-num">94%</div><div class="h-stat-label">Employee Satisfaction</div></div>
    </div>
  </div>
</section>

<!-- WHY DOMA -->
<section class="why-section">
  <div class="why-inner">
    <p class="section-label">Why Doma</p>
    <h2 class="section-title">Benefits & <span>Culture</span></h2>
    <p class="section-desc">We invest in our people with the same conviction we bring to our real estate portfolio.</p>
    <div class="benefits-grid">
      <div class="benefit-card">
        <div class="benefit-icon"><i class="fa fa-chart-line"></i></div>
        <div class="benefit-title">Competitive Compensation</div>
        <div class="benefit-desc">Market-leading salaries benchmarked annually against regional and global peers, plus performance-based bonuses and equity participation for senior roles.</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon"><i class="fa fa-graduation-cap"></i></div>
        <div class="benefit-title">Learning & Development</div>
        <div class="benefit-desc">Annual learning budget of AED 15,000 per person, access to MBA sponsorships, industry certifications, and our internal Doma Academy curriculum.</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon"><i class="fa fa-heart"></i></div>
        <div class="benefit-title">Health & Wellness</div>
        <div class="benefit-desc">Comprehensive private health insurance (family coverage), on-site gym, mental health EAP, and wellness days built into the annual leave policy.</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon"><i class="fa fa-plane"></i></div>
        <div class="benefit-title">Mobility & Travel</div>
        <div class="benefit-desc">Annual home-country flights, 30 days annual leave, and opportunities to work across our MENA and international project sites.</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon"><i class="fa fa-users"></i></div>
        <div class="benefit-title">Diverse Community</div>
        <div class="benefit-desc">32 nationalities under one roof. Our inclusive culture is sustained through ERGs, mentoring programs, and leadership commitments to equity.</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon"><i class="fa fa-building"></i></div>
        <div class="benefit-title">Property Benefits</div>
        <div class="benefit-desc">Staff discounts on Doma residential units, preferential payment plan terms, and priority access to new launches for long-tenured employees.</div>
      </div>
    </div>
  </div>
</section>

<!-- OPEN ROLES -->
<section class="roles-section" id="open-roles">
  <div class="roles-inner">
    <p class="section-label">Open Positions</p>
    <h2 class="section-title">Current <span>Opportunities</span></h2>
    <p class="section-desc">We are seeking exceptional individuals across all functions. 28 roles currently open.</p>

    <div class="roles-filter">
      <button class="role-filter-btn active">All Departments</button>
      <button class="role-filter-btn">Development</button>
      <button class="role-filter-btn">Finance</button>
      <button class="role-filter-btn">Sales & Leasing</button>
      <button class="role-filter-btn">Technology</button>
      <button class="role-filter-btn">Legal</button>
    </div>

    <div class="jobs-list">
      <div class="job-card">
        <div>
          <div class="job-header">
            <div class="job-dept-icon"><i class="fa fa-hard-hat"></i></div>
            <div>
              <div class="job-title">Senior Development Manager — Residential</div>
              <div class="job-meta">
                <span class="job-meta-item"><i class="fa fa-map-marker-alt"></i> Dubai, UAE</span>
                <span class="job-meta-item"><i class="fa fa-briefcase"></i> Full-Time</span>
                <span class="job-meta-item"><i class="fa fa-clock"></i> Posted 3 days ago</span>
              </div>
            </div>
          </div>
          <div class="job-tags" style="margin-top:0.8rem;margin-left:56px;">
            <span class="job-tag">Development</span>
            <span class="job-tag">Senior</span>
            <span class="job-tag">AED 35–50K/mo</span>
          </div>
        </div>
        <button class="job-apply" onclick="openModal('Senior Development Manager — Residential','Development')">Apply Now</button>
      </div>

      <div class="job-card">
        <div>
          <div class="job-header">
            <div class="job-dept-icon"><i class="fa fa-coins"></i></div>
            <div>
              <div class="job-title">Head of Real Estate Finance</div>
              <div class="job-meta">
                <span class="job-meta-item"><i class="fa fa-map-marker-alt"></i> Dubai, UAE</span>
                <span class="job-meta-item"><i class="fa fa-briefcase"></i> Full-Time</span>
                <span class="job-meta-item"><i class="fa fa-clock"></i> Posted 1 week ago</span>
              </div>
            </div>
          </div>
          <div class="job-tags" style="margin-top:0.8rem;margin-left:56px;">
            <span class="job-tag">Finance</span>
            <span class="job-tag">Head of</span>
            <span class="job-tag">AED 45–65K/mo</span>
          </div>
        </div>
        <button class="job-apply" onclick="openModal('Head of Real Estate Finance','Finance')">Apply Now</button>
      </div>

      <div class="job-card">
        <div>
          <div class="job-header">
            <div class="job-dept-icon"><i class="fa fa-laptop-code"></i></div>
            <div>
              <div class="job-title">PropTech Product Manager</div>
              <div class="job-meta">
                <span class="job-meta-item"><i class="fa fa-map-marker-alt"></i> Dubai, UAE</span>
                <span class="job-meta-item"><i class="fa fa-briefcase"></i> Full-Time</span>
                <span class="job-meta-item"><i class="fa fa-clock"></i> Posted 2 weeks ago</span>
              </div>
            </div>
          </div>
          <div class="job-tags" style="margin-top:0.8rem;margin-left:56px;">
            <span class="job-tag">Technology</span>
            <span class="job-tag">Mid-Senior</span>
            <span class="job-tag">AED 25–38K/mo</span>
          </div>
        </div>
        <button class="job-apply" onclick="openModal('PropTech Product Manager','Technology')">Apply Now</button>
      </div>

      <div class="job-card">
        <div>
          <div class="job-header">
            <div class="job-dept-icon"><i class="fa fa-handshake"></i></div>
            <div>
              <div class="job-title">Investment Sales Director — International</div>
              <div class="job-meta">
                <span class="job-meta-item"><i class="fa fa-map-marker-alt"></i> Dubai + Travel</span>
                <span class="job-meta-item"><i class="fa fa-briefcase"></i> Full-Time</span>
                <span class="job-meta-item"><i class="fa fa-clock"></i> Posted 1 week ago</span>
              </div>
            </div>
          </div>
          <div class="job-tags" style="margin-top:0.8rem;margin-left:56px;">
            <span class="job-tag">Sales</span>
            <span class="job-tag">Director</span>
            <span class="job-tag">Base + Commission</span>
          </div>
        </div>
        <button class="job-apply" onclick="openModal('Investment Sales Director — International','Sales & Leasing')">Apply Now</button>
      </div>

      <div class="job-card">
        <div>
          <div class="job-header">
            <div class="job-dept-icon"><i class="fa fa-balance-scale"></i></div>
            <div>
              <div class="job-title">Legal Counsel — Real Estate & Construction</div>
              <div class="job-meta">
                <span class="job-meta-item"><i class="fa fa-map-marker-alt"></i> Dubai, UAE</span>
                <span class="job-meta-item"><i class="fa fa-briefcase"></i> Full-Time</span>
                <span class="job-meta-item"><i class="fa fa-clock"></i> Posted 3 weeks ago</span>
              </div>
            </div>
          </div>
          <div class="job-tags" style="margin-top:0.8rem;margin-left:56px;">
            <span class="job-tag">Legal</span>
            <span class="job-tag">Senior</span>
            <span class="job-tag">AED 30–45K/mo</span>
          </div>
        </div>
        <button class="job-apply" onclick="openModal('Legal Counsel — Real Estate & Construction','Legal')">Apply Now</button>
      </div>
    </div>
  </div>
</section>

<!-- CULTURE -->
<section class="culture-section">
  <div class="culture-inner">
    <p class="section-label" style="color:rgba(188,132,43,0.8);">Our Culture</p>
    <h2 class="section-title" style="color:var(--white);">Where <span>Excellence</span> Meets Purpose</h2>
    <div class="culture-grid">
      <div class="culture-image"><i class="fa fa-users"></i></div>
      <div class="culture-points">
        <div class="culture-point">
          <div class="culture-point-icon"><i class="fa fa-compass"></i></div>
          <div>
            <div class="culture-point-title">Vision-Led Leadership</div>
            <div class="culture-point-desc">Our leadership team is accessible, accountable, and driven by a clear long-horizon vision. Every team member understands how their role connects to Doma's purpose.</div>
          </div>
        </div>
        <div class="culture-point">
          <div class="culture-point-icon"><i class="fa fa-rocket"></i></div>
          <div>
            <div class="culture-point-title">Ownership Mentality</div>
            <div class="culture-point-desc">We don't hire people to execute instructions. We hire people to own outcomes. Autonomy is extended to those who demonstrate the judgment to use it wisely.</div>
          </div>
        </div>
        <div class="culture-point">
          <div class="culture-point-icon"><i class="fa fa-globe"></i></div>
          <div>
            <div class="culture-point-title">Global in Perspective</div>
            <div class="culture-point-desc">Our projects span borders and our thinking follows suit. We actively recruit global talent and expose our teams to international markets and methodologies.</div>
          </div>
        </div>
        <div class="culture-point">
          <div class="culture-point-icon"><i class="fa fa-balance-scale"></i></div>
          <div>
            <div class="culture-point-title">Ethics Without Compromise</div>
            <div class="culture-point-desc">We have walked away from profitable deals that conflicted with our values. Integrity is how we protect the Doma brand — and our people are its guardians.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- APPLICATION MODAL -->
<div class="modal-overlay" id="applyModal">
  <div class="modal">
    <div class="modal-header">
      <div>
        <div class="modal-job-title" id="modal-title">Job Title</div>
        <div class="modal-job-dept" id="modal-dept">Department</div>
      </div>
      <button class="modal-close" onclick="closeModal()"><i class="fa fa-times"></i></button>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">First Name *</label>
          <input class="form-input" type="text" placeholder="Ahmad">
        </div>
        <div class="form-group">
          <label class="form-label">Last Name *</label>
          <input class="form-input" type="text" placeholder="Al-Khalidi">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Email Address *</label>
          <input class="form-input" type="email" placeholder="you@company.com">
        </div>
        <div class="form-group">
          <label class="form-label">Phone Number</label>
          <input class="form-input" type="tel" placeholder="+971 5X XXX XXXX">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Current Company</label>
          <input class="form-input" type="text" placeholder="Current employer">
        </div>
        <div class="form-group">
          <label class="form-label">Years of Experience *</label>
          <select class="form-select">
            <option value="">Select</option>
            <option>2–5 years</option>
            <option>5–10 years</option>
            <option>10–15 years</option>
            <option>15+ years</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Current Location</label>
          <input class="form-input" type="text" placeholder="Dubai, UAE">
        </div>
        <div class="form-group">
          <label class="form-label">Visa Status</label>
          <select class="form-select">
            <option value="">Select</option>
            <option>UAE Resident</option>
            <option>Require Visa</option>
            <option>Other</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group full">
          <label class="form-label">Cover Letter</label>
          <textarea class="form-textarea" placeholder="Tell us why you're the right fit for this role and what you'd bring to Doma Holding…"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Upload CV / Resume *</label>
        <div class="upload-zone">
          <div class="upload-icon"><i class="fa fa-cloud-upload-alt"></i></div>
          <div class="upload-text"><span>Click to upload</span> or drag and drop</div>
          <div class="upload-text" style="font-size:0.7rem;margin-top:4px;">PDF, DOC, DOCX — Max 5MB</div>
        </div>
      </div>
      <button class="form-submit">Submit Application</button>
    </div>
  </div>
</div>

<!-- FOOTER -->
<?php get_footer(); ?>
<?php wp_footer(); ?>

<script>
  function openModal(title, dept) {
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-dept').textContent = dept;
    document.getElementById('applyModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeModal() {
    document.getElementById('applyModal').classList.remove('open');
    document.body.style.overflow = '';
  }
  document.getElementById('applyModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });
  document.querySelectorAll('.role-filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.role-filter-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>
</body>
</html>
