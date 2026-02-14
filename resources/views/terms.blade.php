<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Terms & Conditions - Nichijou Japan ID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0, 0, 0, 0.05)',
                        'card': '0 0 0 1px rgba(0,0,0,0.03), 0 2px 8px rgba(0,0,0,0.04)',
                    },
                    colors: {
                        indigo: {
                            50: '#eef2ff',
                            600: '#4f46e5',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #F8FAFC;
            color: #334155;
        }

        .content-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Smooth anchor offset for sticky headers if needed */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col">

    <div class="flex-grow py-16 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">

            {{-- HEADER SECTION --}}
            <div class="text-center mb-16 space-y-4">
                <span
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50 border border-indigo-100 text-xs font-bold tracking-widest text-indigo-700 uppercase shadow-sm">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    Official Legal Document
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl font-bold text-slate-900 tracking-tight">
                    Terms of Service & Privacy
                </h1>
                <div class="h-1.5 w-24 bg-indigo-600 mx-auto rounded-full opacity-80"></div>
                <p class="text-slate-500 text-sm font-medium">
                    Effective Date: February 14, 2026
                </p>
                <p class="max-w-2xl mx-auto text-slate-600 mt-4 leading-relaxed">
                    Please read these terms carefully. They constitute a legally binding agreement between you and
                    <strong>Nichijou Japan ID</strong> regarding the use of our digital services and products.
                </p>
            </div>

            <div class="space-y-8">

                {{-- 1. INTRO & LEGAL COMPLIANCE (UU ITE FOCUS) --}}
                <section
                    class="content-card rounded-2xl p-8 sm:p-10 shadow-soft relative overflow-hidden group hover:shadow-lg transition-all duration-300">
                    <div class="absolute top-0 left-0 w-1 h-full bg-indigo-600"></div>
                    <div class="flex items-start gap-4">
                        <div class="bg-indigo-50 p-3 rounded-lg text-indigo-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-serif text-2xl font-semibold text-slate-900 mb-3">Legal Compliance & Data
                                Sovereignty</h2>
                            <p class="text-slate-600 leading-relaxed mb-4">
                                Nichijou Japan ID operates in full compliance with applicable laws concerning digital
                                transactions and data privacy. We are committed to upholding:
                            </p>
                            <ul class="space-y-3">
                                <li
                                    class="flex items-start gap-3 text-slate-700 bg-slate-50 p-3 rounded-lg border border-slate-100">
                                    <svg class="w-5 h-5 text-indigo-500 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm"><strong>UU ITE (Law No. 11/2008 & No. 19/2016):</strong>
                                        Ensuring the legality, validity, and enforceability of all electronic
                                        transactions and contracts made on this platform.</span>
                                </li>
                                <li
                                    class="flex items-start gap-3 text-slate-700 bg-slate-50 p-3 rounded-lg border border-slate-100">
                                    <svg class="w-5 h-5 text-indigo-500 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    <span class="text-sm"><strong>UU PDP (Law No. 27/2022):</strong> Strictly regulating
                                        the collection, processing, and protection of your Personal Data (PII) to
                                        prevent misuse or unauthorized access.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                {{-- 2. TRANSACTION SECURITY --}}
                <section class="content-card rounded-2xl p-8 sm:p-10 shadow-soft">
                    <h2 class="font-serif text-2xl font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <span>Transaction Security & Payment</span>
                    </h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        We take the security of your financial information seriously. To ensure a safe shopping
                        experience:
                    </p>
                    <ul class="list-disc pl-5 space-y-2 text-slate-600 text-sm">
                        <li><strong>SSL Encryption:</strong> All data transmitted between your browser and our servers
                            is encrypted using 256-bit Secure Socket Layer (SSL) technology.</li>
                        <li><strong>Payment Validation:</strong> We utilize manual and automated verification for
                            payment proofs (QRIS/Bank Transfer) to prevent fraud and ensure transaction legitimacy.</li>
                        <li><strong>No Stored Credentials:</strong> We do not store your credit card details or bank
                            login credentials on our servers. All processing is handled by secure banking protocols.
                        </li>
                    </ul>
                </section>

                {{-- 3. PRIVACY POLICY --}}
                <section class="content-card rounded-2xl p-8 sm:p-10 shadow-soft">
                    <h2 class="font-serif text-2xl font-semibold text-slate-900 mb-4">Personal Data Protection Policy
                    </h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        In accordance with the <strong>Personal Data Protection Law</strong>, by using our services, you
                        consent to the collection of specific data (Name, Email, Phone Number) strictly for the purpose
                        of:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <h3 class="font-semibold text-slate-800 mb-2">Collected Data</h3>
                            <ul class="text-sm text-slate-600 space-y-1">
                                <li>• Full Legal Name</li>
                                <li>• Active Email Address</li>
                                <li>• WhatsApp/Phone Number</li>
                                <li>• Transaction Proofs</li>
                            </ul>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <h3 class="font-semibold text-slate-800 mb-2">Usage Purpose</h3>
                            <ul class="text-sm text-slate-600 space-y-1">
                                <li>• Digital Product Delivery</li>
                                <li>• Transaction Verification</li>
                                <li>• Customer Support & Updates</li>
                                <li>• Legal Record Keeping</li>
                            </ul>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 mt-4 italic">
                        *We firmly guarantee that your data will NOT be sold, traded, or transferred to unauthorized
                        third parties without your explicit consent.
                    </p>
                </section>

                {{-- 4. DIGITAL PRODUCT POLICY --}}
                <section class="content-card rounded-2xl p-8 sm:p-10 shadow-soft">
                    <h2 class="font-serif text-2xl font-semibold text-slate-900 mb-4">Digital Products & Refund Policy
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        Due to the nature of digital goods (downloadable content, access keys, or materials):
                    </p>
                    <ul class="mt-4 space-y-2 text-slate-600 text-sm border-l-4 border-indigo-200 pl-4">
                        <li>1. All sales are considered <strong>final and non-refundable</strong> once the product
                            access/link has been successfully delivered.</li>
                        <li>2. Refunds are only applicable if there is a proven technical error on our side that
                            prevents you from accessing the purchased content.</li>
                        <li>3. Users are prohibited from redistributing, reselling, or sharing the purchased digital
                            assets. Violations may result in access termination and legal action under Intellectual
                            Property Laws.</li>
                    </ul>
                </section>

                {{-- 5. DISCLAIMER & CONTACT --}}
                <section class="grid md:grid-cols-2 gap-8">
                    <div class="content-card rounded-2xl p-8 shadow-soft">
                        <h2 class="font-serif text-xl font-semibold text-slate-900 mb-3">Limitation of Liability</h2>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Nichijou Japan ID is not liable for any misuse of products or data resulting from user
                            negligence (e.g., sharing passwords, using unsecured networks). Users are responsible for
                            maintaining the confidentiality of their own account access.
                        </p>
                    </div>
                    <div class="content-card rounded-2xl p-8 shadow-soft bg-indigo-900 text-white border-none">
                        <h2 class="font-serif text-xl font-semibold text-white mb-3">Contact Support</h2>
                        <p class="text-sm text-indigo-200 mb-4">
                            Have questions about our terms or security?
                        </p>
                        <a href="mailto:nichijoujapan@gmail.com"
                            class="inline-flex items-center gap-2 text-white font-medium hover:text-indigo-200 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            nichijoujapan@gmail.com
                        </a>
                        <p class="text-xs text-indigo-300 mt-6">
                            Operating Entity: Nichijou Japan ID<br>
                            Jurisdiction: Indonesia / Japan
                        </p>
                    </div>
                </section>

            </div>

            {{-- FOOTER --}}
            <footer class="mt-20 border-t border-slate-200 pt-8 text-center">
                <p class="text-slate-400 text-xs mb-2">
                    Protected by reCAPTCHA and Subject to the Google Privacy Policy and Terms of Service.
                </p>
                <p class="text-slate-500 text-sm font-medium">
                    &copy; 2026 Nichijou Japan ID. All rights reserved.
                </p>
            </footer>

        </div>
    </div>

</body>

</html>
