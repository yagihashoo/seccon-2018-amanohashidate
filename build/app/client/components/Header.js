import Link from 'next/link';

const Header = () => (
    <header>
        <Link href="/">
            <a>Challenges</a>
        </Link>
        <Link href="/upload">
            <a>Upload Challenge</a>
        </Link>
        <Link href="/upgrade">
            <a>Upgrade account</a>
        </Link>
        <Link href="/unsolved">
            <a>Unsolved Challenges</a>
        </Link>
        <style jsx>{`
        a {
            color: red;
        }

        a:hover {
            color: blue;
        }
        `}</style>
    </header>
);

export default Header;