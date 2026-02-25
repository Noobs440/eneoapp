<!DOCTYPE html>
<!-- saved from url=(0037)http://localhost:5173/admin/dashboard -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="module">import { injectIntoGlobalHook } from "/@react-refresh";
injectIntoGlobalHook(window);
window.$RefreshReg$ = () => {};
window.$RefreshSig$ = () => (type) => type;</script>

    <script type="module" src="./eneo-factures-admin_files/client"></script>

    
    <link rel="icon" type="image/svg+xml" href="http://localhost:5173/vite.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eneo-factures</title>
  <style type="text/css" data-vite-dev-id="C:/Users/LENOVO/Downloads/noobs/noobs/eneo-factures/src/pages/auth/auth.css">:root {
  --eneo-primary: #0033a0;
  --eneo-dark: #07245c;
  --eneo-accent: #ffd200;
  --white: #ffffff;
  --muted: #6c757d;
  height: 2em;
}

.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(180deg, #c5c8cc 0%, #7b7e83 100%);
  padding: 2rem;
}

.auth-form {
  background: var(--white);
  padding: 2rem;
  border-radius: 8px;
  width: 360px;
  max-width: 95%;
  box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
  border-top: 6px solid var(--eneo-accent);
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.auth-form h2 {
  margin: 0 0 0.5rem 0;
  color: var(--eneo-dark);
  text-align: center;
}

.auth-error {
  color: #c92a2a;
  margin: 0;
  text-align: center;
}

.auth-input {
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 1rem;
}

.auth-input:focus {
  outline: none;
  border-color: var(--eneo-primary);
  box-shadow: 0 0 0 3px rgba(0, 51, 160, 0.12);
}

.auth-button {
  padding: 10px;
  border: none;
  border-radius: 6px;
  background: var(--eneo-primary);
  color: var(--white);
  cursor: pointer;
  font-weight: 600;
}

.auth-button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.auth-button:hover:not(:disabled) {
  background: var(--eneo-dark);
}

.auth-link {
  color: var(--eneo-primary);
  text-decoration: underline;
}

@media (max-width: 420px) {
  .auth-form {
    width: 100%;
    padding: 1.5rem;
  }
}
</style><style type="text/css" data-vite-dev-id="C:/Users/LENOVO/Downloads/noobs/noobs/eneo-factures/src/pages/user/user.css">.payment-options { display:flex; gap:12px; align-items:center; margin-top:8px; }
.payment-option { display:flex; flex-direction:column; align-items:center; justify-content:center; width:160px; height:110px; border-radius:10px; border:1px solid rgba(238,242,255,0.6); background:linear-gradient(180deg,#fff,#fbfdff); cursor:pointer; transition: all .14s ease; padding:10px; box-shadow: 0 6px 18px rgba(3,51,160,0.04); }
.payment-option:hover { transform: translateY(-4px); box-shadow: 0 8px 18px rgba(0,51,160,0.08); }
.payment-option.selected { border-color: var(--eneo-primary); box-shadow: 0 12px 30px rgba(3,51,160,0.14); transform: translateY(-6px); }
.payment-option img.logo { width:84px; height:48px; object-fit:contain; display:block; }
.payment-option .label { font-size:13px; color:var(--muted); margin-top:6px; }
.payment-option[aria-pressed="true"] { outline: 3px solid rgba(0,51,160,0.12); }
.payment-helpers { display:flex; gap:12px; align-items:center; margin-top:12px; }
.payment-helpers .note { color:var(--muted); font-size:13px; }

/* two-column payment layout for payment page */
.payment-grid {
	display: grid;
	grid-template-columns: 1fr 360px;
	gap: 20px;
	align-items: start;
}
.payment-left { padding-right: 6px; }
.payment-right { padding-left: 6px; }

@media (max-width: 820px) {
	.payment-grid { grid-template-columns: 1fr; }
	.payment-right { order: 2; }
	.payment-left { order: 1; }
}

/* User layout shell */
.user-shell { display: flex; min-height: 100vh; background: var(--eneo-surface); }
.user-sidebar {
	width: 260px;
	background: linear-gradient(180deg, rgba(0,51,160,0.03), rgba(7,36,92,0.02));
	border-right: 1px solid rgba(0,0,0,0.04);
	position: sticky;
	top: 0;
	height: 100vh;
	flex: 0 0 260px;
	overflow: auto;
}
.user-main { flex: 1 1 auto; display: block; }

@media (max-width: 900px) {
	.user-sidebar { display: none; }
}

/* persistent header in user layout */
.user-header {
	position: sticky;
	top: 0;
	height: 88px;
	padding: 0;
	margin: 0;
	display: flex;
	align-items: center;
	justify-content: space-between;
	background: linear-gradient(90deg, rgba(0,51,160,0.95), rgba(7,36,92,0.85));
	color: var(--white);
	z-index: 40;
	border-bottom: 1px solid rgba(0,0,0,0.06);
	box-shadow: 0 6px 22px rgba(0,37,110,0.12);
	/* layout handles spacing below header */
}
.user-header h1 { margin: 0; font-size: 1.125rem; color: var(--white); font-weight: 800; letter-spacing: 0.2px; }
/* header inner layout */
.user-header-inner { display:flex; align-items:center; justify-content:space-between; width:100%; max-width:1180px; margin:0 auto; }
.user-header-left .title { font-size: 1.125rem; font-weight: 800; color: var(--white); margin: 0; }
.user-header-right { display:flex; align-items:center; gap: 12px; }
.user-meta { display:flex; align-items:center; gap:10px; }
.user-avatar { width:44px; height:44px; border-radius:10px; object-fit:cover; border: 2px solid rgba(255,255,255,0.12); }
.user-avatar-fallback { display:flex; align-items:center; justify-content:center; background: rgba(255,255,255,0.08); color: var(--white); font-weight:700; }
.user-info { display:flex; flex-direction:column; line-height:1; }
.user-name { font-weight:700; font-size:13px; color: #fff; }
.user-email { font-size:12px; color: rgba(255,255,255,0.85); }
.small-link { color: rgba(255,255,255,0.9); font-size:12px; text-decoration: underline; margin-left: 8px; }

/* on smaller screens reduce size a bit */
@media (max-width: 820px) {
	.user-header { height: 68px; padding: 0; }
	.user-header h1 { font-size: 1rem; }
	.user-header-inner { padding: 0 12px; }
	.user-header-right .user-info { display:none; }
}

/* ===== User area professional theme ===== */
.user-main { color: #243240; font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }

/* center main content and add breathing room */
.user-main > div { max-width: 1180px; margin: 0 auto; padding: 6px 14px; }

/* cards inside user area: modern elevated surface */
.user-main .admin-card {
	background: linear-gradient(180deg, #ffffff, #fbfcff);
	border-radius: 12px;
	padding: 18px;
	box-shadow: 0 6px 24px rgba(16, 24, 40, 0.08);
	border: 1px solid rgba(12, 17, 31, 0.04);
}

/* profile page */
.profile-card { padding: 22px; }
.profile-grid { display: grid; grid-template-columns: 260px 1fr; gap: 24px; align-items: start; }
.profile-left { text-align: center; }
.profile-avatar-wrap { width: 160px; height: 160px; margin: 0 auto; border-radius: 12px; overflow: hidden; background: linear-gradient(180deg,#f6f8ff,#ffffff); border: 1px solid rgba(3,51,160,0.04); display:flex; align-items:center; justify-content:center; }
.profile-avatar { width:100%; height:100%; object-fit:cover; display:block; }
.profile-avatar-fallback { font-size: 46px; color: var(--eneo-muted); background: #f3f5ff; display:flex; align-items:center; justify-content:center; height:100%; width:100%; }
.profile-right { display:flex; flex-direction:column; gap:12px; }
.profile-fields { display:grid; grid-template-columns: 1fr 1fr; gap:12px; margin-top: 8px; }
.profile-fields label { display:flex; flex-direction:column; gap:6px; }
.profile-section { padding-bottom: 6px; border-bottom: 1px dashed rgba(0,0,0,0.04); }

@media (max-width:980px) {
	.profile-grid { grid-template-columns: 1fr; }
	.profile-left { order: -1; }
	.profile-avatar-wrap { margin-bottom: 8px; }
	.profile-fields { grid-template-columns: 1fr; }
}

/* section titles */
.user-main h3, .user-main h4 { color: var(--eneo-dark); margin: 0 0 12px 0; font-weight: 700; }
.user-main h3 { font-size: 1.05rem; }

/* standardized spacing around sections */
.user-main > .mt-4 { margin-top: 20px; }
.user-main .mt-4 + .mt-4 { margin-top: 18px; }

/* nicer tables */
.user-main table { width: 100%; border-collapse: collapse; font-size: 14px; }
.user-main table thead th { text-align: left; padding: 12px; background: linear-gradient(180deg, rgba(3,51,160,0.03), rgba(7,36,92,0.01)); border-bottom: 1px solid rgba(3,51,160,0.06); font-weight: 700; color: var(--eneo-dark); }
.user-main table tbody td { padding: 10px 12px; border-bottom: 1px solid rgba(0,0,0,0.04); vertical-align: middle; }
.user-main table tbody tr:hover { background: rgba(3,51,160,0.02); }

/* enhanced buttons for user area */
.user-main .auth-button {
	background: var(--eneo-primary);
	border-radius: 8px;
	padding: 8px 12px;
	font-weight: 700;
	color: #fff;
	box-shadow: 0 10px 26px rgba(3,51,160,0.06);
}
.user-main .auth-button[disabled] { opacity: 0.6; cursor: not-allowed; }
.user-main .auth-button.secondary { background: #6b7280; box-shadow: none; }

/* inputs and controls */
.user-main .auth-input { padding: 10px 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.08); font-size: 14px; }
.user-main .auth-input:focus { outline: none; box-shadow: 0 6px 18px rgba(3,51,160,0.08); border-color: rgba(0,51,160,0.12); }
/* clearer disabled inputs so users know they must click Modifier */
.user-main .auth-input[disabled] { background: #f6f7fb; opacity: 0.95; cursor: not-allowed; }

/* top-right header small actions */
.user-header .user-actions { display:flex; gap:8px; align-items:center; }
.user-header .cta { background: rgba(255,255,255,0.12); color: #fff; padding: 6px 10px; border-radius: 8px; font-weight:700; text-decoration:none; }

/* sidebar nav links (user area) */
.user-sidebar .auth-button { display:block; text-align:left; width:100%; background: transparent; color: rgba(3,37,110,0.92); padding: 10px 12px; border-radius: 8px; font-weight:700; box-shadow: none; border: 1px solid transparent; }
.user-sidebar .auth-button.active, .user-sidebar .auth-button:hover { background: rgba(0,51,160,0.07); }

/* small utility */
.muted { color: var(--eneo-muted); }

/* status badges refined */
.user-main .status-badge { padding: 6px 10px; border-radius: 999px; font-weight:700; font-size: 12px; display:inline-block; }
.user-main .status-paid { background: rgba(22,163,74,0.12); color: var(--success); }
.user-main .status-unpaid { background: rgba(239,68,68,0.08); color: var(--danger); }
.user-main .status-pending { background: rgba(245,158,11,0.08); color: var(--warning); }

/* modal overlay & content styling used frequently in user pages */
.user-main .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.38); display:flex; align-items:center; justify-content:center; z-index: 50; }
.user-main .modal-card { width: 760px; max-width: calc(100% - 36px); border-radius: 12px; padding: 22px; box-shadow: 0 18px 60px rgba(3,37,110,0.12); background: linear-gradient(180deg,#ffffff,#fcfdff); border: 1px solid rgba(0,0,0,0.04); }

/* password modal improvements */
.pwd-row { display:flex; flex-direction:column; gap:8px; margin-bottom:6px; }
.pwd-row .pwd-toggle { font-size: 12px; color: var(--eneo-primary); background: transparent; border: none; cursor: pointer; padding: 6px; border-radius: 6px; }
.pwd-row .pwd-toggle:hover { background: rgba(3,51,160,0.04); }
.pwd-strength { display:flex; align-items:center; gap:12px; margin-top: 6px; }
.pwd-strength-bar { display:flex; gap:6px; width: 170px; }
.strength-seg { flex:1; height:8px; border-radius: 6px; background: rgba(10,10,10,0.06); transition: background .14s ease; }
.strength-seg.active { background: linear-gradient(90deg, #ff7a7a, #ffb86b); }
.pwd-strength-label { font-size:12px; }

/* smaller modal layout for tiny screens */
@media (max-width:520px) {
	.user-main .modal-card { padding: 16px; }
	.pwd-strength-bar { width: 120px; }
}

/* compact meter card inside dashboard */
.meter-grid { display: grid; grid-template-columns: 1fr; gap: 12px; }

.meter-tile { display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 12px; align-items: center; padding: 14px; border-radius: 10px; background: linear-gradient(180deg,#fff,#fbfdff); border: 1px solid rgba(3,51,160,0.04); }
.meter-tile .meter-number { font-weight:800; color: var(--eneo-dark); font-size: 15px; }
.meter-tile .meter-meta { font-size: 13px; color: var(--eneo-muted); }

@media (max-width: 980px) {
	.meter-tile { grid-template-columns: 1fr 1fr; }
	.meter-tile > .actions { grid-column: 1 / -1; display:flex; gap:8px; justify-content:flex-end; }
}

/* responsive tweaks */
@media (max-width: 980px) {
	.user-main .admin-card { padding: 14px; }
	.user-header-inner { max-width: 960px; }
}

</style><style type="text/css" data-vite-dev-id="C:/Users/LENOVO/Downloads/noobs/noobs/eneo-factures/node_modules/react-phone-number-input/style.css">/* CSS variables. */
:root {
	--PhoneInput-color--focus: #03b2cb;
	--PhoneInputInternationalIconPhone-opacity: 0.8;
	--PhoneInputInternationalIconGlobe-opacity: 0.65;
	--PhoneInputCountrySelect-marginRight: 0.35em;
	--PhoneInputCountrySelectArrow-width: 0.3em;
	--PhoneInputCountrySelectArrow-marginLeft: var(--PhoneInputCountrySelect-marginRight);
	--PhoneInputCountrySelectArrow-borderWidth: 1px;
	--PhoneInputCountrySelectArrow-opacity: 0.45;
	--PhoneInputCountrySelectArrow-color: currentColor;
	--PhoneInputCountrySelectArrow-color--focus: var(--PhoneInput-color--focus);
	--PhoneInputCountrySelectArrow-transform: rotate(45deg);
	--PhoneInputCountryFlag-aspectRatio: 1.5;
	--PhoneInputCountryFlag-height: 1em;
	--PhoneInputCountryFlag-borderWidth: 1px;
	--PhoneInputCountryFlag-borderColor: rgba(0,0,0,0.5);
	--PhoneInputCountryFlag-borderColor--focus: var(--PhoneInput-color--focus);
	--PhoneInputCountryFlag-backgroundColor--loading: rgba(0,0,0,0.1);
}

.PhoneInput {
	/* This is done to stretch the contents of this component. */
	display: flex;
	align-items: center;
}

.PhoneInputInput {
	/* The phone number input stretches to fill all empty space */
	flex: 1;
	/* The phone number input should shrink
	   to make room for the extension input */
	min-width: 0;
}

.PhoneInputCountryIcon {
	width: calc(var(--PhoneInputCountryFlag-height) * var(--PhoneInputCountryFlag-aspectRatio));
	height: var(--PhoneInputCountryFlag-height);
}

.PhoneInputCountryIcon--square {
	width: var(--PhoneInputCountryFlag-height);
}

.PhoneInputCountryIcon--border {
	/* Removed `background-color` because when an `<img/>` was still loading
	   it would show a dark gray rectangle. */
	/* For some reason the `<img/>` is not stretched to 100% width and height
	   and sometime there can be seen white pixels of the background at top and bottom. */
	background-color: var(--PhoneInputCountryFlag-backgroundColor--loading);
	/* Border is added via `box-shadow` because `border` interferes with `width`/`height`. */
	/* For some reason the `<img/>` is not stretched to 100% width and height
	   and sometime there can be seen white pixels of the background at top and bottom,
	   so an additional "inset" border is added. */
	box-shadow: 0 0 0 var(--PhoneInputCountryFlag-borderWidth) var(--PhoneInputCountryFlag-borderColor),
		inset 0 0 0 var(--PhoneInputCountryFlag-borderWidth) var(--PhoneInputCountryFlag-borderColor);
}

.PhoneInputCountryIconImg {
	/* Fixes weird vertical space above the flag icon. */
	/* https://gitlab.com/catamphetamine/react-phone-number-input/-/issues/7#note_348586559 */
	display: block;
	/* 3rd party <SVG/> flag icons won't stretch if they have `width` and `height`.
	   Also, if an <SVG/> icon's aspect ratio was different, it wouldn't fit too. */
	width: 100%;
	height: 100%;
}

.PhoneInputInternationalIconPhone {
	opacity: var(--PhoneInputInternationalIconPhone-opacity);
}

.PhoneInputInternationalIconGlobe {
	opacity: var(--PhoneInputInternationalIconGlobe-opacity);
}

/* Styling native country `<select/>`. */

.PhoneInputCountry {
	position: relative;
	align-self: stretch;
	display: flex;
	align-items: center;
	margin-right: var(--PhoneInputCountrySelect-marginRight);
}

.PhoneInputCountrySelect {
	position: absolute;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	z-index: 1;
	border: 0;
	opacity: 0;
	cursor: pointer;
}

.PhoneInputCountrySelect[disabled],
.PhoneInputCountrySelect[readonly] {
	cursor: default;
}

.PhoneInputCountrySelectArrow {
	display: block;
	content: '';
	width: var(--PhoneInputCountrySelectArrow-width);
	height: var(--PhoneInputCountrySelectArrow-width);
	margin-left: var(--PhoneInputCountrySelectArrow-marginLeft);
	border-style: solid;
	border-color: var(--PhoneInputCountrySelectArrow-color);
	border-top-width: 0;
	border-bottom-width: var(--PhoneInputCountrySelectArrow-borderWidth);
	border-left-width: 0;
	border-right-width: var(--PhoneInputCountrySelectArrow-borderWidth);
	transform: var(--PhoneInputCountrySelectArrow-transform);
	opacity: var(--PhoneInputCountrySelectArrow-opacity);
}

.PhoneInputCountrySelect:focus + .PhoneInputCountryIcon + .PhoneInputCountrySelectArrow {
	opacity: 1;
	color: var(--PhoneInputCountrySelectArrow-color--focus);
}

.PhoneInputCountrySelect:focus + .PhoneInputCountryIcon--border {
	box-shadow: 0 0 0 var(--PhoneInputCountryFlag-borderWidth) var(--PhoneInputCountryFlag-borderColor--focus),
		inset 0 0 0 var(--PhoneInputCountryFlag-borderWidth) var(--PhoneInputCountryFlag-borderColor--focus);
}

.PhoneInputCountrySelect:focus + .PhoneInputCountryIcon .PhoneInputInternationalIconGlobe {
	opacity: 1;
	color: var(--PhoneInputCountrySelectArrow-color--focus);
}</style><style type="text/css" data-vite-dev-id="C:/Users/LENOVO/Downloads/noobs/noobs/eneo-factures/src/pages/admin/admin.css">:root {
  --eneo-primary: #0033a0;
  --eneo-dark: #07245c;
  --eneo-accent: #ffd200;
  --white: #ffffff;
  --muted: #6c757d;
  --success: #16a34a;
  --danger: #ef4444;
  --warning: #f59e0b;
}

.admin-shell {
  display: flex;
  min-height: 100vh;
  background: #f4f6fb;
}

.admin-sidebar {
  width: 220px;
  background: linear-gradient(180deg, var(--eneo-primary), var(--eneo-dark));
  color: var(--white);
  padding: 1rem 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  /* make the aside fixed/sticky so it's always visible */
  position: sticky;
  top: 0;
  height: 100vh;
  overflow: auto;
  z-index: 30;
}

.admin-logo {
  font-weight: 700;
  font-size: 1.1rem;
  padding: 0.75rem 1rem;
  border-bottom: 1px solid rgba(255,255,255,0.06);
}

/* profile block inside sidebar */
.admin-profile-aside { padding: 12px 14px; display:flex; align-items:center; gap:10px; border-bottom: 1px solid rgba(255,255,255,0.04); }
.admin-profile-aside .profile-link-aside { display:flex; gap:10px; align-items:center; text-decoration:none; color: inherit; }
.sidebar-avatar { width:72px; height:72px; border-radius:12px; overflow:hidden; display:flex; align-items:center; justify-content:center; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.04); }
.sidebar-avatar img { width:100%; height:100%; object-fit:cover; display:block; }
.sidebar-initials { font-weight:700; color:#fff; font-size:18px; }
.sidebar-info { display:flex; flex-direction:column; line-height:1; }
.sidebar-name { font-weight:700; font-size:14px; }
.sidebar-email { font-size:12px; color: rgba(255,255,255,0.85); }

.admin-nav {
  display: flex;
  flex-direction: column;
  padding: 0.5rem 0;
  gap: 0.25rem;
}

.admin-nav a {
  color: rgba(255,255,255,0.9);
  padding: 0.6rem 1rem;
  text-decoration: none;
  display: block;
}

.admin-nav a.active,
.admin-nav a:hover {
  background: rgba(255,255,255,0.08);
}

.admin-main {
  flex: 1 1 auto;
  display: flex;
  flex-direction: column;
}

.admin-topbar {
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1rem;
  background: linear-gradient(90deg, rgba(0,51,160,0.06), rgba(7,36,92,0.03));
  border-bottom: 1px solid rgba(0,0,0,0.04);
}

/* Profile circle in topbar */
.profile-link { text-decoration: none; }
.profile-circle {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--navy-dark);
  color: var(--white);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  overflow: hidden;
}
.profile-circle img { width: 100%; height: 100%; object-fit: cover; display: block; }
.profile-circle:hover { filter: brightness(0.95); }

.admin-content {
  padding: 1.5rem;
}

.admin-card {
  background: var(--white);
  padding: 1rem;
  border-radius: 8px;
  box-shadow: 0 6px 18px rgba(0,51,160,0.06);
}

/* modal overlay & card for admin area (centered popup) */
.admin-main .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.38); display:flex; align-items:center; justify-content:center; z-index: 60; }
.admin-main .modal-card { width: 760px; max-width: calc(100% - 36px); border-radius: 12px; padding: 22px; box-shadow: 0 18px 60px rgba(3,37,110,0.12); background: linear-gradient(180deg,#ffffff,#fcfdff); border: 1px solid rgba(0,0,0,0.04); }

/* meters list inside admin user modal */
.meters-list { display:flex; flex-direction:column; gap:8px; }
.meter-row { display:flex; align-items:center; gap:8px; }
.meter-row .auth-input { flex:1; }

/* admin profile styles */
.profile-card { padding: 22px; }
.profile-grid { display: grid; grid-template-columns: 260px 1fr; gap: 24px; align-items: start; }
.profile-left { text-align: center; }
.profile-avatar-wrap { width: 160px; height: 160px; margin: 0 auto; border-radius: 12px; overflow: hidden; background: linear-gradient(180deg,#f6f8ff,#ffffff); border: 1px solid rgba(3,51,160,0.04); display:flex; align-items:center; justify-content:center; }
.profile-avatar { width:100%; height:100%; object-fit:cover; display:block; }
.profile-avatar-fallback { font-size: 46px; color: var(--muted); background: #f3f5ff; display:flex; align-items:center; justify-content:center; height:100%; width:100%; }
.profile-right { display:flex; flex-direction:column; gap:12px; }
.profile-fields { display:grid; grid-template-columns: 1fr 1fr; gap:12px; margin-top: 8px; }
.profile-fields label { display:flex; flex-direction:column; gap:6px; }
.profile-fields .auth-input[disabled] { background: #f6f7fb; opacity: 0.95; cursor: not-allowed; }
.profile-section { padding-bottom: 6px; border-bottom: 1px dashed rgba(0,0,0,0.04); }

@media (max-width:980px) {
  .profile-grid { grid-template-columns: 1fr; }
  .profile-left { order: -1; }
  .profile-avatar-wrap { margin-bottom: 8px; }
  .profile-fields { grid-template-columns: 1fr; }
}



@media (max-width: 800px) {
  .admin-sidebar { display: none; }
}

  /* Status badges */
  .status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 12px;
    text-transform: capitalize;
  }

  .status-paid {
    background: rgba(22,163,74,0.12);
    color: var(--success);
  }

  .status-unpaid {
    background: rgba(239,68,68,0.12);
    color: var(--danger);
  }

  .status-pending {
    background: rgba(245,158,11,0.08);
    color: var(--warning);
  }

</style></head>
  <body>
    <div id="root"><div class="admin-shell"><aside class="admin-sidebar"><div class="admin-logo">ENEO - Admin</div><div class="admin-profile-aside"><a title="Modifier le profil" class="profile-link-aside" href="http://localhost:5173/admin/profil" data-discover="true"><div class="sidebar-avatar"><span class="sidebar-initials">A</span></div><div class="sidebar-info"><div class="sidebar-name">Administrateur</div><div class="sidebar-email muted"></div></div></a></div><nav class="admin-nav"><a aria-current="page" class="active" href="http://localhost:5173/admin/dashboard" data-discover="true">Dashboard</a><a class="" href="http://localhost:5173/admin/factures" data-discover="true">Factures</a><a class="" href="http://localhost:5173/admin/utilisateurs" data-discover="true">Utilisateurs</a><a class="" href="http://localhost:5173/admin/statistiques" data-discover="true">Statistiques</a></nav></aside><div class="admin-main"><header class="admin-topbar"><div style="font-weight: 600; color: var(--eneo-dark);">Espace Administrateur</div><div style="display: flex; align-items: center; gap: 12px;"><div style="text-align: right; color: var(--muted);"><div style="font-size: 12px;">Bienvenue</div><div style="font-weight: 600; color: var(--eneo-dark);">Administrateur</div></div><a title="Modifier le profil" class="profile-link" href="http://localhost:5173/admin/profil" data-discover="true"><div class="profile-circle"><span>A</span></div></a></div></header><main class="admin-content"><div class="p-6"><div style="display: flex; align-items: center; justify-content: space-between;"><h1 class="text-3xl font-bold">Dashboard Admin</h1><div><button class="auth-button">Mon profil</button></div></div><div class="mt-4 admin-card"><h2 style="margin-top: 0px;">Utilisateurs — par numéro de compteur</h2><div style="overflow-x: auto;"><table style="width: 100%; border-collapse: collapse;"><thead><tr style="text-align: left; border-bottom: 1px solid rgb(230, 230, 230);"><th style="padding: 8px;">Nom</th><th style="padding: 8px;">Email</th><th style="padding: 8px;">Numéros de compteur</th><th style="padding: 8px;">Consommation (kWh)</th><th style="padding: 8px;">Envoyer facture</th></tr></thead><tbody><tr style="border-bottom: 1px solid rgb(240, 240, 240);"><td style="padding: 8px;">Société A</td><td style="padding: 8px;">contact@societea.ci</td><td style="padding: 8px;">CPT-10001, CPT-40001, CPT-40002, CPT-40003</td><td style="padding: 8px;"><div style="display: flex; gap: 8px; align-items: center;"><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Ancien index</div><div style="font-weight: 600;">—</div></div><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Nouvel index</div><input min="0" step="1" placeholder="2144" aria-label="Nouvel index pour Société A" type="number" value="" style="width: 120px; padding: 6px; border-radius: 6px; border: 1px solid rgb(230, 230, 230);"></div><div style="display: flex; flex-direction: column; gap: 6px; align-items: center;"><div style="font-size: 12px; color: var(--muted);">kWh</div><div style="font-weight: 700;">2144</div></div><div><button class="auth-button" style="padding: 6px 10px;">Enregistrer</button></div></div></td><td style="padding: 8px;"><button class="auth-button" style="margin-right: 8px;">Envoyer facture</button></td></tr><tr style="border-bottom: 1px solid rgb(240, 240, 240);"><td style="padding: 8px;">M. Kouadio</td><td style="padding: 8px;">kouadio@example.com</td><td style="padding: 8px;">CPT-10002, CPT-20011, CPT-20012</td><td style="padding: 8px;"><div style="display: flex; gap: 8px; align-items: center;"><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Ancien index</div><div style="font-weight: 600;">—</div></div><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Nouvel index</div><input min="0" step="1" placeholder="335" aria-label="Nouvel index pour M. Kouadio" type="number" value="" style="width: 120px; padding: 6px; border-radius: 6px; border: 1px solid rgb(230, 230, 230);"></div><div style="display: flex; flex-direction: column; gap: 6px; align-items: center;"><div style="font-size: 12px; color: var(--muted);">kWh</div><div style="font-weight: 700;">335</div></div><div><button class="auth-button" style="padding: 6px 10px;">Enregistrer</button></div></div></td><td style="padding: 8px;"><button class="auth-button" style="margin-right: 8px;">Envoyer facture</button></td></tr><tr style="border-bottom: 1px solid rgb(240, 240, 240);"><td style="padding: 8px;">Entreprise B</td><td style="padding: 8px;">contact@entrepriseb.ci</td><td style="padding: 8px;">CPT-10003</td><td style="padding: 8px;"><div style="display: flex; gap: 8px; align-items: center;"><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Ancien index</div><div style="font-weight: 600;">—</div></div><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Nouvel index</div><input min="0" step="1" placeholder="710" aria-label="Nouvel index pour Entreprise B" type="number" value="" style="width: 120px; padding: 6px; border-radius: 6px; border: 1px solid rgb(230, 230, 230);"></div><div style="display: flex; flex-direction: column; gap: 6px; align-items: center;"><div style="font-size: 12px; color: var(--muted);">kWh</div><div style="font-weight: 700;">710</div></div><div><button class="auth-button" style="padding: 6px 10px;">Enregistrer</button></div></div></td><td style="padding: 8px;"><button class="auth-button" style="margin-right: 8px;">Envoyer facture</button></td></tr><tr style="border-bottom: 1px solid rgb(240, 240, 240);"><td style="padding: 8px;">Mme. Traoré</td><td style="padding: 8px;">traore@example.com</td><td style="padding: 8px;">CPT-10004</td><td style="padding: 8px;"><div style="display: flex; gap: 8px; align-items: center;"><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Ancien index</div><div style="font-weight: 600;">—</div></div><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Nouvel index</div><input min="0" step="1" placeholder="165" aria-label="Nouvel index pour Mme. Traoré" type="number" value="" style="width: 120px; padding: 6px; border-radius: 6px; border: 1px solid rgb(230, 230, 230);"></div><div style="display: flex; flex-direction: column; gap: 6px; align-items: center;"><div style="font-size: 12px; color: var(--muted);">kWh</div><div style="font-weight: 700;">165</div></div><div><button class="auth-button" style="padding: 6px 10px;">Enregistrer</button></div></div></td><td style="padding: 8px;"><button class="auth-button" style="margin-right: 8px;">Envoyer facture</button></td></tr><tr style="border-bottom: 1px solid rgb(240, 240, 240);"><td style="padding: 8px;">Société C</td><td style="padding: 8px;">contact@societec.ci</td><td style="padding: 8px;">CPT-10005, CPT-10006, CPT-20013</td><td style="padding: 8px;"><div style="display: flex; gap: 8px; align-items: center;"><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Ancien index</div><div style="font-weight: 600;">—</div></div><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Nouvel index</div><input min="0" step="1" placeholder="718" aria-label="Nouvel index pour Société C" type="number" value="" style="width: 120px; padding: 6px; border-radius: 6px; border: 1px solid rgb(230, 230, 230);"></div><div style="display: flex; flex-direction: column; gap: 6px; align-items: center;"><div style="font-size: 12px; color: var(--muted);">kWh</div><div style="font-weight: 700;">718</div></div><div><button class="auth-button" style="padding: 6px 10px;">Enregistrer</button></div></div></td><td style="padding: 8px;"><button class="auth-button" style="margin-right: 8px;">Envoyer facture</button></td></tr><tr style="border-bottom: 1px solid rgb(240, 240, 240);"><td style="padding: 8px;">Mme. N'Diaye</td><td style="padding: 8px;">ndiaye@example.com</td><td style="padding: 8px;">CPT-30021, CPT-30022, CPT-30023</td><td style="padding: 8px;"><div style="display: flex; gap: 8px; align-items: center;"><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Ancien index</div><div style="font-weight: 600;">—</div></div><div style="display: flex; flex-direction: column; gap: 6px;"><div style="font-size: 12px; color: var(--muted);">Nouvel index</div><input min="0" step="1" placeholder="221" aria-label="Nouvel index pour Mme. N&#39;Diaye" type="number" value="" style="width: 120px; padding: 6px; border-radius: 6px; border: 1px solid rgb(230, 230, 230);"></div><div style="display: flex; flex-direction: column; gap: 6px; align-items: center;"><div style="font-size: 12px; color: var(--muted);">kWh</div><div style="font-weight: 700;">221</div></div><div><button class="auth-button" style="padding: 6px 10px;">Enregistrer</button></div></div></td><td style="padding: 8px;"><button class="auth-button" style="margin-right: 8px;">Envoyer facture</button></td></tr></tbody></table></div></div></div></main></div></div></div>
    <script type="module" src="./eneo-factures-admin_files/main.tsx"></script>
  

</body></html>