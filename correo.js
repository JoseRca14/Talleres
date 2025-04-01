import { Resend } from 'resend';

const resend = new Resend('ApiKey');

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