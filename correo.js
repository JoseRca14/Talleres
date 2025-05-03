import { Resend } from 'resend';

const resend = new Resend('re_RB9eK6XM_GAoenDSg9VrtZTEt81czFCZt');

async function sendEmails(toEmails, subject, htmlContent) {
  try {
    const { data, error } = await resend.emails.send({
      from: 'TallerLeon <TallerLeon@resend.dev>',
      to: toEmails,
      subject: subject,
      html: htmlContent,
    });

    if (error) {
      console.error({ error });
      return;
    }

    console.log({ data });
  } catch (error) {
    console.error('Error sending emails:', error);
  }
}

export default sendEmails;