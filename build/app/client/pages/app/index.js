import Layout from '../../components/layout';
import Link from 'next/link';
import {axiosWrapper} from '../../lib/utils';
import Router from 'next/router'
import bulma from "bulma";

const Index = (props) => (
    <Layout title={"Top"}>
        <table className={bulma.table + ' ' + bulma['is-fullwidth'] + ' ' + bulma['is-striped']}>
            <thead>
            <tr>
                <th>id</th>
                <th>title</th>
            </tr>
            </thead>
            <tbody>
            {props.data.challenges.map((challenge, i) => (
                <tr key={challenge.id}>
                    <td>{i+1}</td>
                    <td>
                        <Link as={`/app/c/${challenge.id}`} href={`/app/challenge?id=${challenge.id}`}>
                            <a>{challenge.title}</a>
                        </Link>
                    </td>
                </tr>
            ))}
            </tbody>
        </table>
    </Layout>
)

Index.getInitialProps = async function ({req, res}) {
    const axios = (new axiosWrapper(req)).axios;
    let apiRes;
    try {
        apiRes = await axios.get('/challenge/?filter=solved');
    } catch (err) {
        const status = err.response.status;
        if (req) {
            switch (status) {
                case 401:
                    res.redirect('/login');
                    res.end();
                    break;
                case 403:
                    res.redirect('/app/me');
                    res.end();
                    break;
            }
        } else {
            switch (status) {
                case 401:
                    Router.push('/login');
                    break;
                case 403:
                    Router.push('/app/me');
                    break;
            }
        }

        return {
            data: {challenges: []},
        };
    }

    return {
        data: apiRes.data,
    };
};

export default Index;
