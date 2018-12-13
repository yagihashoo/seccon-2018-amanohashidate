import Head from 'next/head';
import Link from 'next/link';
import bulma from 'bulma';

const Layout = ({children, title = 'Challenges'}) => (
    <div id="wrap">
        <Head>
            <title>{`${title} - XSS Hell`}</title>
            <link rel="stylesheet" href="/static/app.css"/>
        </Head>
        <header>
            <nav className={bulma.navbar} role="navigation" aria-label="main navigation">
                <div className={bulma['navbar-brand']}>
                    <Link href={"/app"}><a className={bulma.title + ' ' + bulma['is-1'] + ' ' + bulma['navbar-item']}>XSS Hell</a></Link>
                </div>
                <div className={bulma['navbar-menu']}>
                    <div className={bulma['navbar-end']}>
                        <Link href={"/app"}>
                            <a className={bulma['navbar-item']}>Challenges</a>
                        </Link>
                        <Link href={"/app/upload"}>
                            <a className={bulma['navbar-item']}>Upload</a>
                        </Link>
                        <Link href={"/app/me"}>
                            <a className={bulma['navbar-item']}>Profile</a>
                        </Link>
                        <Link href={"/logout"}>
                            <a className={bulma['navbar-item']}>Logout</a>
                        </Link>
                    </div>
                </div>
            </nav>
        </header>
        <div className="content">
            <h2 className={bulma.title + ' ' + bulma['is-3']}>{title}</h2>
            {children}
        </div>
        <footer>
            ©Yu YAGIHASHI, Developed For SECCON CTF 2018
        </footer>
    </div>
);

export default Layout;