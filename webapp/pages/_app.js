import '@/styles/globals.css'
import 'bootstrap/dist/css/bootstrap.css';
import 'react-toastify/dist/ReactToastify.css';
import { ToastContainer } from 'react-toastify';

export default function App({ Component, pageProps }) {
  return (<>
    <Component {...pageProps} />
    <ToastContainer />
    </>)
}
