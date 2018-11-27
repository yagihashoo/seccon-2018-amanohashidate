import Layout from '../../components/layout';
import {axiosWrapper} from '../../lib/utils';
import Router from 'next/router'

const Index = (props) => (
    <Layout title={"Top"}>
        <ul>
            {props.data.challenges.map((challenge) => (
                <li key={challenge.id}>
                    <p>{challenge.id}</p>
                    <p>{challenge.name}</p>
                </li>
            ))}
        </ul>
    </Layout>
)

Index.getInitialProps = async function ({req, res}) {
    const axios = (new axiosWrapper(req)).axios;
    let apiRes;
    try {
        apiRes = await axios.get('/challenge/');
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
